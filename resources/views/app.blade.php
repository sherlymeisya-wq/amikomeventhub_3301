<!DOCTYPE html>
<html>
<head>
    <title>Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="font-bold">Event Hub</h1>
        <div class="space-x-4">
            <a href="/" class="text-blue-500">Home</a>
            <a href="/katalog">Katalog</a>
            <a href="/kontak">Kontak</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-white text-center p-4 mt-10">
        <p>© 2026 Event Hub</p>
    </footer>

</body>
</html>