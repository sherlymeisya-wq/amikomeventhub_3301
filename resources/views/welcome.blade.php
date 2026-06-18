@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">

    <div class="flex-1 space-y-6">
        <h1 class="text-5xl font-extrabold">
            Temukan & Pesan <span class="text-indigo-600">Event Impian</span>
        </h1>
        <p class="text-slate-500 text-lg">
            Semua event kampus hingga nasional ada di sini.
        </p>
    </div>

    <div class="flex-1">
        <!-- FIX ASSET -->
        <img src="{{ asset('assets/concert.png') }}"
             class="rounded-3xl shadow-xl"
             alt="Hero Image">
    </div>

</section>

<!-- CATEGORY -->
<section class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-4">Kategori</h2>

    <div class="flex flex-wrap gap-3">
        @forelse($categories as $category)
            <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-full">
                {{ $category->name }}
            </span>
        @empty
            <p class="text-gray-500">Belum ada kategori</p>
        @endforelse
    </div>
</section>

<!-- EVENTS -->
<section class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-6">Event Terdekat</h2>

    <div class="grid md:grid-cols-3 gap-6">

        @forelse($events as $event)
            <a href="{{ route('events.show', $event->id) }}"
               class="block bg-white rounded-2xl shadow p-4 transition hover:-translate-y-1 hover:shadow-xl">

                <img src="{{ $event->poster_path ? asset($event->poster_path) : asset('assets/concert.png') }}"
                     class="rounded-xl mb-3 w-full h-40 object-cover"
                     alt="Event Image">

                <h3 class="font-bold text-lg">{{ $event->title }}</h3>
                <p class="text-gray-500">
                    {{ $event->category->name ?? '-' }}
                </p>
            </a>
        @empty
            <p class="text-gray-500">Belum ada event</p>
        @endforelse

    </div>
</section>

<!-- PARTNERS -->
<section class="max-w-7xl mx-auto px-6 py-16">

    <h2 class="text-3xl font-extrabold mb-2">Partner Kami</h2>
    <p class="text-gray-500 mb-8">Partner resmi AmikomEventHub</p>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @forelse($partners as $partner)
            <div class="bg-white rounded-2xl shadow p-6 text-center">

                <!-- TETAP DARI DATABASE -->
                <img src="{{ $partner->logo_url }}"
                     class="h-16 mx-auto object-contain"
                     alt="{{ $partner->name }}"
                     onerror="this.src='{{ asset('assets/concert.png') }}'">

                <h3 class="mt-4 font-semibold">
                    {{ $partner->name }}
                </h3>

            </div>
        @empty
            <div class="col-span-4 text-center text-gray-500">
                Belum ada partner
            </div>
        @endforelse

    </div>
</section>

@endsection 