@extends('layouts.admin', ['title' => 'Tambah Partner'])

@section('content')
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Tambah Partner</h1>
        <p class="text-slate-500 font-medium">Tambahkan partner dengan nama dan logo.</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-2xl font-bold hover:bg-slate-200 transition">
        Kembali ke Daftar
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10 max-w-3xl">
    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Partner *</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Amikom Digital"
                class="w-full px-5 py-4 rounded-3xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                required>
            @error('name')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Logo URL</label>
            <input type="url" name="logo_url" value="{{ old('logo_url') }}" placeholder="https://example.com/logo.png"
                class="w-full px-5 py-4 rounded-3xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            @error('logo_url')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-sm text-slate-400">Masukkan URL logo partner atau gunakan upload di bawah.</p>
        </div>

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Upload Logo Partner</label>
            <input type="file" name="logo_file"
                class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-indigo-600 file:text-white file:font-semibold"
                accept="image/*">
            @error('logo_file')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-sm text-slate-400">Jika upload, logo akan disimpan dan dipakai sebagai URL internal.</p>
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.partners.index') }}" class="px-6 py-3 text-slate-700 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">Simpan Partner</button>
        </div>
    </form>
</div>
@endsection
