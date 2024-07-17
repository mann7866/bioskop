<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman welcome
Route::get('/', function () {
    return view('home');
});

// Route untuk otentikasi, termasuk login, register, dan logout
Auth::routes();

// Route untuk home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route untuk logout menggunakan metode POST
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');
