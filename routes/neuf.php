<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/nine', [App\Http\Controllers\NineController::class, 'index'])
        ->name('nine.index');
});
