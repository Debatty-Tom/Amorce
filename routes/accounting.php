<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accounting', [App\Http\Controllers\AccountingController::class, 'index'])
        ->name('accounting.index');
    Route::get('/accounting/create', [App\Http\Controllers\AccountingController::class, 'create'])
        ->name('accounting.create');
});
