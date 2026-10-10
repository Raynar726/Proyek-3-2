<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

// Route untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman produk dan keranjang
Route::get('/', [ProductController::class, 'index']);

// Route untuk keranjang belanja, hanya bisa diakses oleh pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang');
    Route::post('/keranjang/add/{id_barang}', [CartController::class, 'add']);
    Route::post('/keranjang/update/{id_barang}', [CartController::class, 'update']);
    Route::post('/keranjang/remove/{id_barang}', [CartController::class, 'remove']);
    Route::post('/keranjang/clear', [CartController::class, 'clear']);
    Route::post('/checkout', [OrderController::class, 'checkout']); // Route untuk checkout, hanya bisa diakses oleh pengguna yang sudah login
    Route::get('/riwayat-pesanan', [OrderController::class, 'history'])->name('riwayat'); // Route untuk melihat riwayat pesanan, hanya bisa diakses oleh pengguna yang sudah login
});