<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ('<h1>Ini adalah Halaman Tentang Aplikasi Event Hub</h1>');
});

Route::get('/kontak', function () {
return view('kontak');
});

Route::get('/katalog', function () {
return view('katalog');
});

Route::get('/profil', function () {
return view('profil');
});

Route::get('/bantuan', function () {
return view('bantuan');
});