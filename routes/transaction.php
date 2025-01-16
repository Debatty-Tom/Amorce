<?php

use App\Livewire\Accounting\FundTable;
use App\Livewire\Transactions\TransactionsTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/accounting/transaction/{transaction}/edit', FundTable::class)->name('transactions.edit');

    Route::post('/accounting/transactions', TransactionsTable::class)
        ->name('transactions.store');
    Route::delete('/accounting/transactions/delete', TransactionsTable::class)
        ->name('transactions.destroy');
    Route::patch('/accounting/transactions/{transaction}', TransactionsTable::class)
        ->name('transactions.update');
});
