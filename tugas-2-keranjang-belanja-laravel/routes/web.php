<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::get('/tugas2/index', [CartController::class, 'index'])->name('katalog');
Route::get('/tugas2/keranjang', [CartController::class, 'cart'])->name('keranjang');
Route::post('/tugas2/keranjang/add/{id}', [CartController::class, 'add']);
Route::post('/tugas2/keranjang/update/{id}', [CartController::class, 'updateQty']);
Route::post('/tugas2/keranjang/remove/{id}', [CartController::class, 'remove']);
Route::post('/tugas2/keranjang/clear', [CartController::class, 'clear']);