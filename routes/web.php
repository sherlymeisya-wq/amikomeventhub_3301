<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController; // Tambahan Import Webhook

// Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes - Sisi Pengguna (User-facing)
|--------------------------------------------------------------------------
*/

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail Event
Route::get('/event/{event}', [EventController::class, 'show'])->name('events.show');

// Checkout & Pembayaran
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [CheckoutController::class, 'success'])->name('checkout.success');

// Tiket Pengguna
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// Redirect login bawaan Laravel ke halaman login milik admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| Midtrans Webhook (Callback)
|--------------------------------------------------------------------------
| Wajib diletakkan di luar middleware 'auth' agar server Midtrans dapat mengaksesnya.
*/
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle'])->name('midtrans.callback');


/*
|--------------------------------------------------------------------------
| Admin Area Grouping
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // --- Autentikasi Admin (Bisa diakses tanpa login) ---
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- Panel Kontrol Utama Admin (Wajib Login 'auth') ---
    Route::middleware(['auth'])->group(function () {
        
        // Dashboard Ringkasan (Pertemuan 12)
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Manajemen Data
        Route::resource('events', AdminEventController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);

        // Riwayat Transaksi Masuk
        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    });

});


/*
|--------------------------------------------------------------------------
| Static Pages (Halaman Statis)
|--------------------------------------------------------------------------
*/
Route::get('/kontak', function () { return view('contact'); });
Route::get('/profil', function () { return view('profil'); });
Route::get('/katalog', function () { return view('katalog'); });
Route::get('/bantuan', function () { return view('bantuan'); });