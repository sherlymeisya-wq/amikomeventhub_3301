@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-10">

    <h1 class="text-3xl font-bold mb-4">
        {{ $event->title }}
    </h1>

    <p class="mb-4">
        {{ $event->description }}
    </p>

    <p class="text-green-600 font-bold mb-2">
        Harga: Rp {{ number_format($event->price,0,',','.') }}
    </p>

    <p class="mb-4">
        Stok: {{ $event->stock }}
    </p>

    <a href="{{ route('checkout.create', $event->id) }}"
        class="bg-green-500 text-white px-4 py-2 rounded">
        Beli Tiket
    </a>

</div>

@endsection