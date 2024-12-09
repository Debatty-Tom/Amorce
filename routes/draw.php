<?php


use App\Livewire\Draws\DrawsTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/draw', DrawsTable::class)
        ->name('draw.index');
});
