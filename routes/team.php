<?php


use App\Livewire\Team\TeamTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/team', TeamTable::class)
        ->name('team.index');

    Route::get('/team/create', TeamTable::class)
        ->name('team.create');
});
