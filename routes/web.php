<?php
// routes/web.php

use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\f\FilmController;
use App\Http\Controllers\genreController;

// Route untuk halaman welcome
// Route::get('/', function () {
//     return view('home');
// });

// Route untuk otentikasi, termasuk login, register, dan logout
Auth::routes();

// Route untuk home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/errors', [App\Http\Controllers\Notfoundcontroller::class, 'errors'])->name('errors.notfound');
// Route Genre
Route::get('/genre', [App\Http\Controllers\genreController::class,'index'])->name('genre');
Route::get('/genre/index', [App\Http\Controllers\genreController::class,'tampilan'])->name('genre.tampilan');
Route::get('/genre/create', [App\Http\Controllers\genreController::class,'create'])->name('genre.create');
Route::post('/genre/store', [App\Http\Controllers\genreController::class,'store'])->name('genre.store');
Route::get('/genre/{id}/edit', [App\Http\Controllers\genreController::class,'edit'])->name('genre.edit');
Route::put('/genre/{id}/update', [App\Http\Controllers\genreController::class,'update'])->name('genre.update');
Route::get('/genre/{id}/delete', [App\Http\Controllers\genreController::class,'destroy'])->name('genre.delete');

// Route Time
Route::get('/time', [App\Http\Controllers\timeController::class,'index'])->name('time');
Route::get('/time/create', [App\Http\Controllers\timeController::class,'create'])->name('time.create');
Route::post('/time/store', [App\Http\Controllers\timeController::class,'store'])->name('time.store');
Route::get('/time/{id}/edit', [App\Http\Controllers\timeController::class,'edit'])->name('time.edit');
Route::put('/time/{id}/update', [App\Http\Controllers\timeController::class,'update'])->name('time.update');
Route::get('/time/{id}/delete', [App\Http\Controllers\timeController::class,'destroy'])->name('time.delete');
// Route Detail
Route::get('/detail', [App\Http\Controllers\DetailController::class,'index'])->name('detail');
Route::get('/film', [App\Http\Controllers\DetailController::class,'show'])->name('film');
Route::get('/detail/create', [App\Http\Controllers\DetailController::class,'create'])->name('detail.create');
Route::post('/detail/store', [App\Http\Controllers\DetailController::class,'store'])->name('detail.store');
Route::get('/detail/{id}/edit', [App\Http\Controllers\DetailController::class,'edit'])->name('detail.edit');
Route::put('/detail/{id}/update', [App\Http\Controllers\DetailController::class,'update'])->name('detail.update');
Route::get('/detail/{id}/delete', [App\Http\Controllers\DetailController::class,'destroy'])->name('detail.delete');

// Route Kursi
Route::get('/kursi', [App\Http\Controllers\KursiController::class,'index'])->name('kursi');
Route::get('/kursi/create', [App\Http\Controllers\KursiController::class,'create'])->name('kursi.create');
Route::post('/kursi/store', [App\Http\Controllers\KursiController::class,'store'])->name('kursi.store');
Route::get('/kursi/{id}/edit', [App\Http\Controllers\KursiController::class,'edit'])->name('kursi.edit');
Route::put('/kursi/{id}/update', [App\Http\Controllers\KursiController::class,'update'])->name('kursi.update');
Route::get('/kursi/{id}/delete', [App\Http\Controllers\KursiController::class,'destroy'])->name('kursi.delete');


Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/{id}/create', [OrderController::class, 'order'])->name('order.create');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}/pembayaran', [App\Http\Controllers\OrderController::class,'edit'])->name('pembayaran');
Route::put('/order/{id}/update', [App\Http\Controllers\OrderController::class,'update'])->name('order.update');
Route::get('/order/{id}/delete', [App\Http\Controllers\OrderController::class,'destroy'])->name('order.delete');
Route::put('/paid/{id}/order', [App\Http\Controllers\OrderController::class,'paid'])->name('paid');
Route::put('/cancel/{id}/order', [App\Http\Controllers\OrderController::class,'cancel'])->name('cancel');


Route::get('/berita', [App\Http\Controllers\BeritaController::class,'index'])->name('berita');
Route::get('/berita/create', [App\Http\Controllers\BeritaController::class,'create'])->name('berita.create');
Route::post('/berita/store', [App\Http\Controllers\BeritaController::class,'store'])->name('berita.store');
Route::get('/berita/{id}/edit', [App\Http\Controllers\BeritaController::class,'edit'])->name('berita.edit');
Route::put('/berita/{id}/update', [App\Http\Controllers\BeritaController::class,'update'])->name('berita.update');
Route::Get('/berita/{id}/delete', [App\Http\Controllers\BeritaController::class,'destroy'])->name('berita.delete');

