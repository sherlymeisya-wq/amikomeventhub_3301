<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TransactionController;

// Halaman Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail Event
Route::get('/event/{event}', [EventController::class, 'show'])
    ->name('events.show');

// Checkout
Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
    ->name('checkout.create');

Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
    ->name('checkout.store');

// Tiket
Route::get('/my-ticket', [EventController::class, 'ticket'])
    ->name('ticket');

// Redirect login Laravel ke login admin
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Login Admin
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

// Area Admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth']
], function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD Event
    Route::resource('events', AdminEventController::class);

    // CRUD Kategori
    Route::resource('categories', CategoryController::class);

    // CRUD Partner
    Route::resource('partners', PartnerController::class);

    // Transaksi
    Route::get('transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
});

// Halaman Statis
Route::get('/kontak', function () {
    return view('contact');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/bantuan', function () {
    return view('bantuan');
});