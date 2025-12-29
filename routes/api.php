<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\Api\DocumentsController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\OmbudsmanController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CollaboratorAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public GET routes
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{id}', [NewsController::class, 'show']);

Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/calendar/{id}', [CalendarController::class, 'show']);

Route::get('/documents', [DocumentsController::class, 'index']);
Route::get('/documents/{id}', [DocumentsController::class, 'show']);

Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{slug}', [PageController::class, 'show']);

Route::get('/menu', [MenuController::class, 'index']);

// Public POST route for Ombudsman
Route::post('/ombudsman', [OmbudsmanController::class, 'store']);

// Public POST route for Collaborator Login
Route::post('/login', [CollaboratorAuthController::class, 'login']);

