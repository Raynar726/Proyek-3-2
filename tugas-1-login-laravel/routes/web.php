<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;

// Route untuk user yang belum login (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'autenthicate']);
});

// Route untuk halaman dashboard dan logout, hanya dapat diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::patch('/admin/users/{user}/role', 
    [RoleController::class, 'update']) 
    ->middleware(['auth', 'can:manage-roles']) 
    ->name('admin.users.role.update');

Route::post('/cart/add', function () {
    return response()->json(['message' => 'Simulasi cart berhasil']);
})->middleware(['auth', 'can:use-cart']);