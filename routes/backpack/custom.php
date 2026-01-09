<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('news', 'NewsCrudController');
    Route::crud('ombudsman', 'OmbudsmanCrudController');
    Route::crud('document-category', 'DocumentCategoryCrudController');
    Route::crud('documents', 'DocumentsCrudController');
    Route::crud('calendar', 'CalendarCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('tenant', 'TenantCrudController');
    Route::crud('menu-item', 'MenuItemCrudController');
    Route::crud('collaborators', 'CollaboratorsCrudController');
    Route::crud('banner', 'BannerCrudController');
    Route::crud('task', 'TaskCrudController');
    Route::crud('dashboard', 'DashboardCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
