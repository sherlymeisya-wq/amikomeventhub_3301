@extends('layouts.admin')

@section('content')

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">
        Laporan Transaksi
    </h1>

    <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Order ID</th>
                    <th class="p-3 text-left">Event</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transactions as $transaction)
                    <tr class="border-b">
                        <td class="p-3">{{ $transaction->order_id }}</td>
                        <td class="p-3">{{ $transaction->event->title ?? '-' }}</td>
                        <td class="p-3">{{ $transaction->customer_name }}</td>
                        <td class="p-3">{{ $transaction->customer_email }}</td>
                        <td class="p-3">
                            Rp {{ number_format($transaction->total_price,0,',','.') }}
                        </td>
                        <td class="p-3">
                            {{ $transaction->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center">
                            Belum ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection