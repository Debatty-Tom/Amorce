<?php


use App\Livewire\Profile\UserTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', UserTable::class)
        ->name('profile.index');

});
