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
Route::get('/news/{slug}', [NewsController::class, 'show']);

Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/calendar/upcoming', [CalendarController::class, 'upcoming']);
Route::get('/calendar/{id}', [CalendarController::class, 'show']);

Route::get('/documents', [DocumentsController::class, 'index']);
Route::get('/documents/search', [DocumentsController::class, 'search']);
Route::get('/documents/categories', [DocumentsController::class, 'getCategories']);
Route::get('/documents/category/{category}', [DocumentsController::class, 'show_by_category']);
Route::get('/documents/{id}', [DocumentsController::class, 'show']);

Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{slug}', [PageController::class, 'show']);

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/main', [MenuController::class, 'main']);
Route::get('/menu/fastaccess', [MenuController::class, 'fastaccess']);
Route::get('/menu/links', [MenuController::class, 'links']);

// Public POST route
Route::middleware(['frontend.only'])->group(function () {
    Route::post('/ombudsman', [OmbudsmanController::class, 'store']);
    Route::post('/task', [App\Http\Controllers\Api\TaskController::class, 'store']);
    Route::put('/task/{id}', [App\Http\Controllers\Api\TaskController::class, 'update']);
    Route::post('/task/{id}', [App\Http\Controllers\Api\TaskController::class, 'archive']);
    Route::post('/task/{id}/unarchive', [App\Http\Controllers\Api\TaskController::class, 'unarchive']);
    Route::post('/dashboard', [App\Http\Controllers\Api\DashboardController::class, 'store']);
    Route::put('/dashboard/{id}', [App\Http\Controllers\Api\DashboardController::class, 'update']);
    Route::delete('/dashboard/{id}', [App\Http\Controllers\Api\DashboardController::class, 'destroy']);

});

Route::get('/dashboard/personal/{id}', [App\Http\Controllers\Api\DashboardController::class, 'personal']);
Route::get('/dashboard', [App\Http\Controllers\Api\DashboardController::class, 'index']);
Route::get('/dashboard/{id}', [App\Http\Controllers\Api\DashboardController::class, 'show']);
Route::get('/dashboard/collaborator/{id}', [App\Http\Controllers\Api\DashboardController::class, 'getCollaboratorDashboards']);

Route::get('/task/archived', [App\Http\Controllers\Api\TaskController::class, 'getArchivedTasks']);
Route::get('/task/collaborator/{collaborator_id}', [App\Http\Controllers\Api\TaskController::class, 'showCollaboratorTasks']);
Route::get('/task/collaborator/sender/{collaborator_id}', [App\Http\Controllers\Api\TaskController::class, 'showCollaboratorSenderTasks']);
Route::get('/task/{id}', [App\Http\Controllers\Api\TaskController::class, 'show']);

Route::get('collaborators', [App\Http\Controllers\Api\CollaboratorAuthController::class, 'getCollaborators']);

Route::get('/ombudsman/{response_token}', [OmbudsmanController::class, 'show']);

// Public POST route for Collaborator Login
Route::post('/login', [CollaboratorAuthController::class, 'login']);
Route::get('/birthdays', [CollaboratorAuthController::class, 'birthdays']);
Route::get('/banners', [App\Http\Controllers\Api\BannerController::class, 'index']);
Route::get('/banners/{id}', [App\Http\Controllers\Api\BannerController::class, 'show']);
