<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - Temukan Event Seru!</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

<!-- NAV -->
<nav class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border shadow-lg flex justify-between items-center">
    <div class="flex items-center gap-2">
        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
            AH
        </div>
        <span class="text-xl font-bold">AmikomEventHub</span>
    </div>
</nav>

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
        <img src="{{ asset('assets/concert.png') }}" class="rounded-3xl shadow-xl" alt="Hero Image">
    </div>

</section>

<!-- CATEGORIES -->
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
            <div class="bg-white rounded-2xl shadow p-4">

                <!-- FIX IMAGE EVENT -->
                <img
                    src="{{ asset('assets/concert.png') }}"
                    class="rounded-xl mb-3 w-full h-40 object-cover"
                    alt="Event Image"
                >

                <h3 class="font-bold text-lg">{{ $event->title }}</h3>
                <p class="text-gray-500">{{ $event->category->name ?? '-' }}</p>
            </div>
        @empty
            <p class="text-gray-500">Belum ada event</p>
        @endforelse

    </div>

</section>

<!-- PARTNERS -->
<section class="max-w-7xl mx-auto px-6 py-16">

    <h2 class="text-3xl font-extrabold mb-2">Partner Kami</h2>
    <p class="text-gray-500 mb-8">Partner resmi AmikomEventHub</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

        @forelse($partners as $partner)
            <div class="bg-white rounded-2xl shadow p-6 text-center hover:shadow-lg transition">

                <img
                    src="{{ $partner->logo_url }}"
                    alt="{{ $partner->name }}"
                    class="h-16 mx-auto object-contain"
                    onerror="this.src='https://placehold.co/200x100?text=Partner'"
                >

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

<!-- FOOTER -->
<footer class="bg-indigo-900 text-white text-center py-10 mt-20">
    <p>© 2024 AmikomEventHub</p>
</footer>

</body>
</html>