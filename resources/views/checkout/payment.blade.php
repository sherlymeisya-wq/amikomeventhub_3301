@extends('layouts.app')
@section('title', 'Pembayaran - ' . $transaction->event->title)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-12 shadow-sm inline-block w-full max-w-md">
        <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-black mb-2">Selesaikan Pembayaran</h2>
        <p class="text-slate-500 mb-8">Mohon selesaikan pembayaran tiket Anda untuk event <strong>{{ $transaction->event->title }}</strong>.</p>
        
        <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 mb-8">
            <p class="text-sm text-slate-400 font-bold uppercase tracking-wider mb-1">Total Tagihan</p>
            <h3 class="text-4xl font-extrabold text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
        </div>

        <button id="pay-button" class="w-full bg-indigo-600 text-white font-bold py-4 rounded-2xl hover:bg-indigo-700 transition duration-300 shadow-lg shadow-indigo-100 mb-4">
            Bayar Sekarang
        </button>
        <a href="/" class="text-sm text-slate-400 hover:text-slate-600 font-medium transition">Kembali ke Beranda</a>
    </div>
</main>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Memicu jendela popup Snap Midtrans menggunakan token dari database
        window.snap.pay('{{ $transaction->snap_token }}', {
            onSuccess: function(result){
                /* Panggilan balik saat pembayaran sukses */
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            onPending: function(result){
                /* Panggilan balik saat status pending (menunggu transfer) */
                window.location.href = "{{ route('checkout.success', $transaction->order_id) }}";
            },
            onError: function(result){
                /* Panggilan balik saat error */
                alert("Pembayaran gagal diproses!");
            },
            onClose: function(){
                /* Panggilan balik saat user menutup popup tanpa membayar */
                alert('Anda menutup halaman pembayaran sebelum menyelesaikan transaksi.');
            }
        });
    });
</script>
@endsection