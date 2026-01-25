<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::view('/','welcome')->name('welcome');

Route::get('login', function () {
    return redirect()->route('backpack.auth.login');
})->name('login');

// Catch-all route for pages
Route::get('{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '.*');