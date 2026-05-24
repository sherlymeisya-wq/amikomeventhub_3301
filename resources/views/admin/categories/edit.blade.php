@extends('layouts.admin', ['title' => 'Edit Kategori'])

@section('content')
<header class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black">Edit Kategori</h1>
        <p class="text-slate-500 font-medium">Perbarui nama kategori untuk event Anda.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 rounded-2xl font-bold hover:bg-slate-200 transition">
        Kembali ke Daftar
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-10 max-w-3xl">
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Contoh: Seminar"
                class="w-full px-5 py-4 rounded-3xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                required>
            @error('name')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4 pt-4">
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 text-slate-700 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">Batal</a>
            <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">Perbarui Kategori</button>
        </div>
    </form>
</div>
@endsection
