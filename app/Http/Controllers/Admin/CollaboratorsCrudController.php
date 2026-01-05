<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CollaboratorsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CollaboratorsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CollaboratorsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Collaborators::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/collaborators');
        CRUD::setEntityNameStrings('collaborators', 'collaborators');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Nome');
        CRUD::column('email')->label('Email');
        CRUD::column('position')->label('Cargo');
        CRUD::column('department')->label('Departamento');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CollaboratorsRequest::class);

        CRUD::field('name')->label('Nome');
        CRUD::field('email')->label('Email')->type('email');
        CRUD::field('password')->label('Senha')->type('password');
        CRUD::field('position')->label('Cargo');
        CRUD::field('department')->label('Departamento');
        CRUD::field('birth_date')->label('Data de Nascimento')->type('date');
        CRUD::field('url_photo')->label('Foto')->type('upload')->upload(true);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
