<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::redirect('/', '/admin/dashboard')->name('home');
});

// Catch-all route for pages
Route::get('{slug}', [App\Http\Controllers\PageController::class, 'index'])->where('slug', '.*');
