<?php

use App\Livewire\Calendar;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/calendar', Calendar::class)
        ->name('calendar.index');
});
