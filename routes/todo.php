<?php


use App\Livewire\Todo\TodosTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/todo', TodosTable::class)
        ->name('todo.index');
});
