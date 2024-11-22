<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/nine', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('nine.index');
});
