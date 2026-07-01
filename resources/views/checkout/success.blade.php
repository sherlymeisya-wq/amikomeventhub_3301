@extends('layouts.app')
@section('title', 'Pembayaran Berhasil')

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-12 shadow-sm inline-block w-full max-w-md">
        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-black mb-4">Terima Kasih!</h2>
        <p class="text-slate-500 mb-8 leading-relaxed">
            Pembayaran untuk pesanan <strong class="text-slate-800 font-mono">{{ $transaction->order_id }}</strong> sedang diproses atau telah berhasil[cite: 13077].<br>
            Detail e-ticket akan diperbarui secara otomatis setelah pembayaran terkonfirmasi[cite: 13078].
        </p>
        <a href="/" class="inline-block bg-indigo-600 text-white font-bold py-3 px-8 rounded-2xl hover:bg-indigo-700 transition shadow-md">
            Kembali Jelajahi Event
        </a>
    </div>
</main>
@endsection