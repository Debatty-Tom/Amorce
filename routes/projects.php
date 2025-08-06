<?php


use App\Livewire\Project\ProjectsTable;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/projects', ProjectsTable::class)
        ->name('projects.index');
});
