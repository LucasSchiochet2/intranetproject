<?php

namespace App\Http\Controllers\Admin;

use Backpack\PermissionManager\app\Http\Controllers\RoleCrudController as OriginalRoleCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class RoleCrudController extends OriginalRoleCrudController
{
    public function setup()
    {
        parent::setup();

        if (!backpack_user()->can('list roles')) {
            CRUD::denyAccess(['list', 'show']);
        }
        if (!backpack_user()->can('create roles')) {
            CRUD::denyAccess(['create']);
        }
        if (!backpack_user()->can('update roles')) {
            CRUD::denyAccess(['update']);
        }
        if (!backpack_user()->can('delete roles')) {
            CRUD::denyAccess(['delete']);
        }
    }
}
