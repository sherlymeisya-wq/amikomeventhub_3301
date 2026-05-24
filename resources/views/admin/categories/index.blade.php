@extends('layouts.admin', ['title' => 'Kelola Kategori'])

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
    <div>
        <h1 class="text-3xl font-black">Manajemen Kategori</h1>
        <p class="text-slate-500 font-medium">Kelola semua kategori event di platform ini.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">
        + Tambah Kategori
    </a>
</header>

@if(session('success'))
    <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 px-6 py-4 text-green-700">
        {{ session('success') }}
    </div>
@endif

<div class="mb-8 flex flex-col md:flex-row gap-4 md:items-center justify-between">
    <form action="{{ route('admin.categories.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
        <input type="search" name="search" value="{{ old('search', $search) }}" placeholder="Cari nama kategori..."
            class="w-full md:w-80 px-5 py-4 rounded-3xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" />
        <button type="submit" class="px-6 py-4 bg-indigo-600 text-white rounded-3xl font-bold hover:bg-indigo-700 transition">Cari</button>
        @if($search)
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-4 bg-slate-100 text-slate-700 rounded-3xl font-bold hover:bg-slate-200 transition">Reset</a>
        @endif
    </form>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4">ID</th>
                    <th class="px-8 py-4">Nama Kategori</th>
                    <th class="px-8 py-4">Dibuat</th>
                    <th class="px-8 py-4">Diperbarui</th>
                    <th class="px-8 py-4">Jumlah Event</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($categories as $category)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-8 py-6 font-bold text-slate-500">{{ $category->id }}</td>
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-900">{{ $category->name }}</p>
                        <p class="text-xs text-slate-400">{{ $category->slug }}</p>
                    </td>
                    <td class="px-8 py-6 text-slate-500">{{ $category->created_at->format('d M Y H:i') }}</td>
                    <td class="px-8 py-6 text-slate-500">{{ $category->updated_at->format('d M Y H:i') }}</td>
                    <td class="px-8 py-6 text-slate-900 font-bold">{{ $category->events_count }}</td>
                    <td class="px-8 py-6 flex flex-wrap gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="px-4 py-3 bg-blue-50 text-blue-600 rounded-2xl font-bold hover:bg-blue-100 transition">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-3 bg-rose-50 text-rose-600 rounded-2xl font-bold hover:bg-rose-100 transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-16 text-center text-slate-500">Belum ada kategori. Silakan tambahkan kategori baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $categories->links() }}
</div>
@endsection
