<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
require __DIR__.'/dashboard.php';
require __DIR__.'/team.php';
require __DIR__.'/calendrier.php';
require __DIR__.'/neuf.php';
require __DIR__.'/accounting.php';
require __DIR__.'/stock.php';
require __DIR__.'/mailing.php';
require __DIR__.'/todo.php';
require __DIR__ . '/projects.php';
