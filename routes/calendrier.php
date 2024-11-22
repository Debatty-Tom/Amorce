<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'index'])
        ->name('calendar.index');
});
