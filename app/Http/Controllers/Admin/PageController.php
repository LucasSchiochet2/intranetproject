<?php

namespace App\Http\Controllers\Admin;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as PageManagerController;

class PageController extends PageManagerController
{
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(\App\Models\Page::class);
    }
}
