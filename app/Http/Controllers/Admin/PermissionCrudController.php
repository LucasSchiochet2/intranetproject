<?php

namespace App\Http\Controllers\Admin;

use Backpack\PermissionManager\app\Http\Controllers\PermissionCrudController as OriginalPermissionCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PermissionCrudController extends OriginalPermissionCrudController
{
    public function setup()
    {
        parent::setup();

        if (!backpack_user()->can('list permissions')) {
            CRUD::denyAccess(['list', 'show']);
        }
        if (!backpack_user()->can('create permissions')) {
            CRUD::denyAccess(['create']);
        }
        if (!backpack_user()->can('update permissions')) {
            CRUD::denyAccess(['update']);
        }
        if (!backpack_user()->can('delete permissions')) {
            CRUD::denyAccess(['delete']);
        }
    }
}
