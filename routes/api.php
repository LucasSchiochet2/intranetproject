<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PostCategoryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserInterestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::apiResource('quiz', QuizController::class)->only(['index', 'show']);
    Route::apiResource('post-categories', PostCategoryController::class)->only(['index', 'show']);
});

Route::get('/{filename}', function ($filename) {
    if (!Storage::disk('local')->exists($filename)) {
        return response()->json(['message' => 'Image not found.'], 404);
    }
    return Storage::disk('local')->response($filename);
});
