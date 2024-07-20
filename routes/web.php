<?php
// routes/web.php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route untuk halaman welcome
// Route::get('/', function () {
//     return view('home');
// });

// Route untuk otentikasi, termasuk login, register, dan logout
Auth::routes();

// Route untuk home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/genre', [App\Http\Controllers\genreController::class,'index'])->name('genre');
Route::get('/genre/create', [App\Http\Controllers\genreController::class,'create'])->name('genre.create');
Route::post('/genre/store', [App\Http\Controllers\genreController::class,'store'])->name('genre.store');
Route::get('/genre/{id}/edit', [App\Http\Controllers\genreController::class,'edit'])->name('genre.edit');
Route::put('/genre/{id}/update', [App\Http\Controllers\genreController::class,'update'])->name('genre.update');
Route::get('/genre/{id}/delete', [App\Http\Controllers\genreController::class,'destroy'])->name('genre.delete');

Route::get('/time', [App\Http\Controllers\timeController::class,'index'])->name('time');
Route::get('/time/create', [App\Http\Controllers\timeController::class,'create'])->name('time.create');
Route::post('/time/store', [App\Http\Controllers\timeController::class,'store'])->name('time.store');
Route::get('/time/{id}/edit', [App\Http\Controllers\timeController::class,'edit'])->name('time.edit');
Route::put('/time/{id}/update', [App\Http\Controllers\timeController::class,'update'])->name('time.update');
Route::get('/time/{id}/delete', [App\Http\Controllers\timeController::class,'destroy'])->name('time.delete');

Route::get('/detail', [App\Http\Controllers\DetailController::class,'index'])->name('detail');
Route::get('/detail/create', [App\Http\Controllers\DetailController::class,'create'])->name('detail.create');
Route::post('/detail/store', [App\Http\Controllers\DetailController::class,'store'])->name('detail.store');
Route::get('/detail/{id}/edit', [App\Http\Controllers\DetailController::class,'edit'])->name('detail.edit');
Route::put('/detail/{id}/update', [App\Http\Controllers\DetailController::class,'update'])->name('detail.update');
Route::get('/detail/{id}/delete', [App\Http\Controllers\DetailController::class,'destroy'])->name('detail.delete');

Route::get('/genres', [App\Http\Controllers\GenreDetail::class,'index'])->name('genres');
// Route::get('/genres/create', [App\Http\Controllers\GenresController::class,'create'])->name('genres.create');
// Route::post('/genres/store', [App\Http\Controllers\GenresController::class,'store'])->name('genres.store');
// Route::get('/genres/{id}/edit', [App\Http\Controllers\GenresController::class,'edit'])->name('genres.edit');
// Route::put('/genres/{id}/update', [App\Http\Controllers\GenresController::class,'update'])->name('genres.update');
// Route::get('genres/{id}/delete', [App\Http\Controllers\GenresController::class,'destroy'])->name('genres.delete');
