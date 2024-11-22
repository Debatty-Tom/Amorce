<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/projects', [App\Http\Controllers\ProjectsController::class, 'index'])
        ->name('projects.index');
});
