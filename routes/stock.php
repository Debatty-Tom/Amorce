<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/stock', [App\Http\Controllers\StockController::class, 'index'])
        ->name('stock.index');
});
