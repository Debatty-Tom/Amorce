<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mailing', [App\Http\Controllers\StockController::class, 'index'])
        ->name('mailing.index');
});
