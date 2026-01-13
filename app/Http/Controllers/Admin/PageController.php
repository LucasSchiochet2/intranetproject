<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as PageManagerController;

class PageController extends PageManagerController
{
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\App\Models\Page::class);

        if (!backpack_user()->can('list pages')) {
            $this->crud->denyAccess(['list', 'show']);
        }
        if (!backpack_user()->can('create pages')) {
            $this->crud->denyAccess(['create']);
        }
        if (!backpack_user()->can('update pages')) {
            $this->crud->denyAccess(['update']);
        }
        if (!backpack_user()->can('delete pages')) {
            $this->crud->denyAccess(['delete']);
        }
    }
}
