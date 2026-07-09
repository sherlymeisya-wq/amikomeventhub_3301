<?php 

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        try {
            // Membaca notifikasi payload JSON dari Midtrans
            $payload = $request->all();
            
            $orderId = $payload['order_id'] ?? null;
            $statusCode = $payload['status_code'] ?? null;
            $grossAmount = $payload['gross_amount'] ?? null;
            $transactionStatus = $payload['transaction_status'] ?? null;
            $type = $payload['payment_type'] ?? null;
            $serverKey = config('midtrans.server_key') ?? env('MIDTRANS_SERVER_KEY'); // Pastikan Server Key terisi di .env

            // --- FITUR KEAMANAN: Validasi SHA512 Signature Key dari Midtrans ---
            if (isset($payload['signature_key'])) {
                $localSignature = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);
                
                if ($localSignature !== $payload['signature_key']) {
                    Log::warning("Midtrans Webhook: Invalid Signature Key untuk Order ID: " . $orderId);
                    return response()->json(['message' => 'Invalid signature'], 403);
                }
            }

            // Cari transaksi berdasarkan order_id yang dikirim Midtrans
            $transaction = Transaction::where('order_id', $orderId)->first();

            if (!$transaction) {
                return response()->json(['message' => 'Transaction not found'], 404);
            }

            // Kondisional status transaksi dari Midtrans
            if ($transactionStatus == 'capture') {
                if ($type == 'credit_card') {
                    if ($payload['fraud_status'] == 'challenge') {
                        $transaction->status = 'pending';
                    } else {
                        $transaction->status = 'success';
                        $this->processSuccess($transaction);
                    }
                }
            } else if ($transactionStatus == 'settlement') {
                $transaction->status = 'success';
                $this->processSuccess($transaction);
            } else if (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $transaction->status = 'failed';
            } else if ($transactionStatus == 'pending') {
                $transaction->status = 'pending';
            }

            // Simpan perubahan status ke database
            $transaction->save();

            return response()->json(['message' => 'Notification handled successfully', 'status' => $transaction->status]);

        } catch (\Exception $e) {
            // Mencatat log jika terjadi error tak terduga pada sistem internal Anda
            Log::error("Midtrans Webhook Error: " . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    private function processSuccess(Transaction $transaction)
    {
        // Logika tambahan saat transaksi lunas (misal: potong stok tiket, kirim email) 
        // akan diimplementasikan penuh pada materi Modul 13.
        Log::info("Transaksi sukses diproses untuk Order ID: " . $transaction->order_id);
    }
}