<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex justify-center items-center h-screen">

<div class="bg-white p-8 rounded-lg shadow-lg w-96">

    <h1 class="text-2xl font-bold text-center mb-6">
        Login Admin
    </h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label>Email</label>
            <input type="email"
                   name="email"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="w-full border p-2 rounded">
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 rounded">
            Login
        </button>

    </form>

</div>

</body>
</html>