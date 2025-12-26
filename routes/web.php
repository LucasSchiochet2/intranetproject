<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Redirect;

Route::middleware(['auth'])->group(function () {

    Route::redirect('/', '/posts')->name('home');

    Route::resource('users', UserController::class)->except(['show'])->names('users');
    Route::put('/users/{user}/profile', [UserController::class, 'updateProfile'])->name('users.updateProfile');
    Route::put('/users/{user}/interest', [UserController::class, 'updateInterest'])->name('users.updateInterest');
    Route::put('/users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.updateRoles');
    Route::resource('posts', PostController::class)->except(['show'])->names('posts');
    Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
    Route::put('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{post}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::put('/posts/{post}/category', [PostController::class, 'updateCategory'])->name('posts.updateCategory');
    Route::resource('quiz', QuizController::class)->except(['show'])->names('quiz');
    // Route::fallback(function () {
    //     return redirect()->route('home');
    // });
});
Route::get('/debug-r2', function () {
    // Lista TODOS os arquivos que estão no seu bucket R2
    return \Illuminate\Support\Facades\Storage::disk('s3')->allFiles();
});
Route::get('/private-image/{filename}', function ($filename) {
    // 1. Define explicitamente o disco S3
    $disk = Storage::disk('s3');

    // 2. Verifica na RAIZ (onde o debug mostrou que está)
    if ($disk->exists($filename)) {
        return $disk->response($filename);
    }

    // 3. Se falhar, tenta limpar caracteres estranhos (espaços, quebras de linha)
    $cleanName = trim($filename);
    if ($disk->exists($cleanName)) {
        return $disk->response($cleanName);
    }

    abort(404);
});

Route::domain('{subdomain}.' . config('app.domain'))->middleware(['auth'])->group(function () {
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

