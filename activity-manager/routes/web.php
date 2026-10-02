<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('activities', ActivityController::class);
Route::patch('/activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::patch('/activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');