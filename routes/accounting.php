<?php

use App\Livewire\Accounting\FundsTable;
use App\Livewire\Accounting\FundTable;
use App\Livewire\Csv\ImportCsv;
use App\Models\TransactionSummaryView;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accounting', FundsTable::class)
        ->name('accounting.index');

    Route::get('/accounting/{fund_id}', FundTable::class)
        ->name('accounting.show');

    Route::get('/csv', ImportCsv::class)
        ->name('csv.index');
});
