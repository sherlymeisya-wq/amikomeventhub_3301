<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Event
Route::get('/katalog', [EventController::class, 'show'])->name('events.show');
Route::get('/event-detail', [EventController::class, 'detail'])->name('events.detail');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');

// Ticket
Route::get('/ticket', [TicketController::class, 'index'])->name('ticket');

// Tambahan
Route::get('/kontak', fn() => view('kontak'));
Route::get('/profil', fn() => view('profil'));
Route::get('/bantuan', fn() => view('bantuan'));