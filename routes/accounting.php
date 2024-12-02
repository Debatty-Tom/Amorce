<?php

use App\Livewire\Accounting\FundsTable;
use App\Livewire\Accounting\FundTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accounting', FundsTable::class)
        ->name('accounting.index');
    Route::get('/accounting/create', FundsTable::class)
        ->name('accounting.create');

    Route::get('/accounting/{fund}', FundTable::class)
        ->name('accounting.show');
});
