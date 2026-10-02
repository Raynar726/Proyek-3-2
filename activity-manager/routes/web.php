<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/activities/trash', [App\Http\Controllers\ActivityController::class, 'trash'])->name('activities.trash');
Route::patch('/activities/{id}/restore', [App\Http\Controllers\ActivityController::class, 'restore'])->name('activities.restore');
Route::resource('activities', ActivityController::class);
Route::patch('/activities/{activity}/publish', [ActivityController::class, 'publish'])->name('activities.publish');
Route::patch('/activities/{activity}/complete', [ActivityController::class, 'complete'])->name('activities.complete');