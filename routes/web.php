<?php

use Illuminate\Support\Facades\Route;


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

// Serve storage/basset files with CORS headers
Route::get('storage/basset/{path}', function ($path) {
    $file = storage_path('app/public/basset/' . $path);
    if (!file_exists($file)) {
        abort(404);
    }
    $mime = mime_content_type($file);
    $response = response()->file($file, [
        'Access-Control-Allow-Origin' => '*',
        'Content-Type' => $mime,
    ]);
    return $response;
})->where('path', '.*');
