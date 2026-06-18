@extends('layouts.app')

@section('title', 'Checkout - ' . $event->title)

@section('content')
<main class="max-w-3xl mx-auto px-6 py-20">

    <div class="mb-12">
        <a href="{{ route('events.show', $event->id) }}"
            class="text-indigo-600 font-bold flex items-center gap-2 mb-6">
            ← Kembali ke Event
        </a>

        <h1 class="text-4xl font-extrabold">Checkout</h1>

        <p class="text-slate-500 mt-2">
            Lengkapi data Anda untuk mendapatkan tiket.
        </p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-8">

        <!-- Ringkasan Pesanan -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-xl font-bold mb-6 border-b pb-4">
                Pesanan Anda
            </h3>

            <div class="flex gap-6 items-start">

                <img
                    src="https://placehold.co/200x200"
                    alt="Event"
                    class="w-24 h-24 rounded-2xl object-cover">

                <div>

                    <h4 class="font-extrabold text-lg">
                        {{ $event->title }}
                    </h4>

                    <p class="text-slate-500">
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                        •
                        {{ $event->location }}
                    </p>

                    <p class="text-indigo-600 font-bold mt-2">
                        1 x Rp {{ number_format($event->price, 0, ',', '.') }}
                    </p>

                </div>

            </div>

            <div class="mt-8 pt-6 border-t space-y-3">

                <div class="flex justify-between text-slate-500">
                    <span>Harga Tiket</span>
                    <span>
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    </span>
                </div>

                <div class="flex justify-between text-slate-500">
                    <span>Biaya Layanan</span>
                    <span>Rp 5.000</span>
                </div>

                <div class="flex justify-between text-2xl font-black mt-4 pt-4 border-t">

                    <span>Total Bayar</span>

                    <span class="text-indigo-600">
                        Rp {{ number_format($event->price + 5000, 0, ',', '.') }}
                    </span>

                </div>

            </div>

        </div>

        <!-- Form Checkout -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">

            <h3 class="text-xl font-bold mb-6">
                Data Pemesan
            </h3>

            <form
                action="{{ route('checkout.store', $event->id) }}"
                method="POST"
                class="space-y-6">

                @csrf

                <div>

                    <label class="block mb-2 font-semibold">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="customer_name"
                        value="{{ old('customer_name') }}"
                        class="w-full border rounded-xl p-4"
                        required>

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Email
                    </label>

                    <input
                        type="email"
                        name="customer_email"
                        value="{{ old('customer_email') }}"
                        class="w-full border rounded-xl p-4"
                        required>

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Nomor WhatsApp
                    </label>

                    <input
                        type="text"
                        name="customer_phone"
                        value="{{ old('customer_phone') }}"
                        class="w-full border rounded-xl p-4"
                        required>

                </div>

                <button
                    type="submit"
                    class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold">

                    Lanjut Pembayaran

                </button>

            </form>

        </div>

    </div>

</main>
@endsection