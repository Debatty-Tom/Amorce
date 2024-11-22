<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/todo', [App\Http\Controllers\TodoController::class, 'index'])
        ->name('todo.index');
});
