<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        $categories = Category::all();

        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input Form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Validasi Stok Tiket
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000;

        // 3. Rekam Data Transaksi Awal ke Database (Disimpan ke variabel $transaction)
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'Pending',
        ]);

        // 4. Integrasi Midtrans Snap API
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Menggunakan Mode Sandbox (Development)
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Menyusun parameter data untuk dikirim ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            // Meminta Snap Token secara real-time dari Server Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            // Memperbarui baris transaksi di database dengan snap_token yang baru didapat
            $transaction->update(['snap_token' => $snapToken]);

            // Mengalihkan pengguna ke halaman pembayaran khusus (bukan lagi ke halaman utama '/')
            return redirect()->route('checkout.payment', $transaction->order_id);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal terhubung dengan layanan pembayaran: ' . $e->getMessage());
        }
    }

    // 5. Menampilkan Halaman Pembayaran Snap Popup
    public function payment($order_id)
    {
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
        $categories = Category::all();

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            // Sinkronisasi status pembayaran dari server Midtrans demi keamanan jika user me-refresh halaman
            $midtransStatus = \Midtrans\Transaction::status($order_id);
            $transactionStatus = $midtransStatus->transaction_status;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                $transaction->status = 'success';
                $transaction->save();
                return redirect()->route('checkout.success', $order_id);
            }
        } catch (\Exception $e) {
            // Abaikan jika order_id belum ter-registrasi penuh di log server Midtrans
        }

        return view('checkout.payment', compact('transaction', 'categories'));
    }

    // 6. Menampilkan Halaman Sukses Setelah Bayar
    public function success($order_id)
    {
        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
        $categories = Category::all();

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);
            $transactionStatus = $midtransStatus->transaction_status;

            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                $transaction->status = 'success';
                $transaction->save();
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}