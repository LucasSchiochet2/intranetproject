<?php

namespace App\Http\Controllers\Admin;

use Backpack\MenuCRUD\app\Http\Controllers\Admin\MenuItemCrudController as OriginalMenuItemCrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
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

        CRUD::addField([
            'name' => 'menu_key',
            'label' => 'Menu',
            'type' => 'select_from_array',
            'options' => [
                'main' => 'Principal',
                'fastaccess' => 'Acesso Rápido',
                'links' => 'Links Úteis',
            ],
            'allows_null' => false,
            'default' => 'main',
        ]);
    }

    public function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'menu_key',
            'label' => 'Menu',
            'type' => 'select_from_array',
            'options' => [
                'main' => 'Principal',
                'fastaccess' => 'Acesso Rápido',
                'links' => 'Links Úteis',
            ],
        ]);
    }

    public function setupReorderOperation()
    {
        $menuKey = \Request::input('menu_key', 'main');

        $this->crud->addClause('where', 'menu_key', $menuKey);

        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 3);

        Widget::add([
            'type' => 'view',
            'view' => 'inc.menu_reorder_links',
            'menu_key' => $menuKey,
        ])->to('before_content');
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
