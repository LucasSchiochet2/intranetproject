<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Storage::disk('s3')->put('basset/.basset', '');
Storage::disk('public')->put('basset/.basset', '');
Storage::disk('local')->put('basset/.basset', '');
// Registration Routes (subdomain aware)
Route::domain('{subdomain}.' . env('APP_DOMAIN'))->group(function () {
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
    Route::get('/debug-basset', function () {
        return [
            'disk_configurado' => config('backpack.basset.disk'),
                'existe_no_s3' => Storage::disk('s3')->exists('basset/.basset'),
                'url_gerada' => Storage::disk('s3')->url('basset/.basset'),
            ];
    });
});
