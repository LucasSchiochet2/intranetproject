<?php

namespace App\Http\Controllers\Admin;

use Backpack\MenuCRUD\app\Http\Controllers\Admin\MenuItemCrudController as OriginalMenuItemCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\MenuItem;

class MenuItemCrudController extends OriginalMenuItemCrudController
{
    public function setup()
    {
        parent::setup();
        $this->crud->setModel(MenuItem::class);
    }

    public function setupCreateOperation()
    {
        // Define the fields from the parent controller first
        // (This happens automatically because the parent defines them in setup())
        
        // Add the icon field
        CRUD::addField([
            'name' => 'icon',
            'label' => 'Ícone',
            'type' => 'text',
            'hint' => 'Classe do ícone (ex: fa fa-home)',
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
