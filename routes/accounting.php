<?php

use App\Livewire\Accounting\FundsTable;
use App\Livewire\Accounting\FundTable;
use App\Models\TransactionSummaryView;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accounting', FundsTable::class)
        ->name('accounting.index');
    Route::get('/accounting/create', FundsTable::class)
        ->name('accounting.create');

    Route::get('/accounting/{fund_id}', FundTable::class)
        ->name('accounting.show');
});
