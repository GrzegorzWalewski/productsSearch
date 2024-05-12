<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('import-products', 'import-products')->name('import-products');
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
