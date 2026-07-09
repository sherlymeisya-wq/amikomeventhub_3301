<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung total event yang tersedia
        $totalEvents = Event::count();

        // 2. Menghitung total transaksi sukses
        $totalTransactions = Transaction::where('status', 'success')->count();

        // 3. Menghitung total pendapatan dari transaksi yang lunas/success
        $totalRevenue = Transaction::where('status', 'success')->sum('total_price');

        // 4. Menghitung total transaksi dengan status pending (Tambahan Baru)
        $pendingTransactionsCount = Transaction::where('status', 'pending')->count();

        // 5. Mengambil 5 riwayat transaksi terbaru beserta relasi data event-nya
        $recentTransactions = Transaction::with('event')->latest()->take(5)->get();

        // Mempassing seluruh variabel ke dalam view admin.dashboard
        return view('admin.dashboard', compact(
            'totalEvents', 
            'totalTransactions', 
            'totalRevenue', 
            'pendingTransactionsCount', 
            'recentTransactions'
        ));
    }
}