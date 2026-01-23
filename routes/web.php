<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Storage::disk('s3')->put('basset/.basset', '');
// Registration Routes
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::redirect('/', '/admin/dashboard')->name('home');
});

Route::get('login', function () {
    return redirect()->route('backpack.auth.login');
})->name('login');

// Catch-all route for pages
Route::get('{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '.*');
