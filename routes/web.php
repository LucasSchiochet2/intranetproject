<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::view('/','welcome')->name('welcome');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('/', '/admin/dashboard')->name('home');
// });

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
