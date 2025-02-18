<?php


use App\Livewire\Draws\DrawsTable;
use App\Livewire\Draws\DrawTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/draw', DrawsTable::class)
        ->name('draw.index');
    Route::get('/draw/{draw}', DrawTable::class)
        ->name('draw.show');
});
