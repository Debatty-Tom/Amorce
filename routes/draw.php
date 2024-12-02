<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/draw', [App\Http\Controllers\DrawController::class, 'index'])
        ->name('draw.index');
});
