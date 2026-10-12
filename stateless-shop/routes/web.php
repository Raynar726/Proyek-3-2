<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\CartController; 
 
Route::get('/', [CartController::class, 'index']); 
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); 
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');