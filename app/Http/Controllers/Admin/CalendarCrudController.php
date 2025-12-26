<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CalendarRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CalendarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CalendarCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Calendar::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/calendar');
        CRUD::setEntityNameStrings('calendar', 'calendars');

        if (!backpack_user()->can('list calendar')) {
            CRUD::denyAccess(['list', 'show']);
        }
        if (!backpack_user()->can('create calendar')) {
            CRUD::denyAccess(['create']);
        }
        if (!backpack_user()->can('update calendar')) {
            CRUD::denyAccess(['update']);
        }
        if (!backpack_user()->can('delete calendar')) {
            CRUD::denyAccess(['delete']);
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title')->label('Título');
        CRUD::column('start_date')->label('Início')->type('date');
        CRUD::column('end_date')->label('Fim')->type('date');
        CRUD::column('user')->label('Usuário');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CalendarRequest::class);

        CRUD::field('title')->label('Título');
        CRUD::field('description')->label('Descrição')->type('textarea');
        CRUD::field('start_date')->label('Data de Início')->type('date');
        CRUD::field('end_date')->label('Data de Fim')->type('date');
        CRUD::field('user_id')->label('Usuário')->type('select')->entity('user')->attribute('name')->model('App\Models\User');
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
