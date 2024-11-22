<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/team', [App\Http\Controllers\TeamController::class, 'index'])
        ->name('team.index');
});
