<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TaskCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/task');
        CRUD::setEntityNameStrings('task', 'tasks');
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
        CRUD::column('deadline')->label('Prazo')->type('datetime');
        CRUD::column('receiver')->label('Destinatário')->type('select')->entity('receiver')->attribute('name')->model('App\Models\Collaborators');
        CRUD::column('status')->label('Status');
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();
        CRUD::column('description')->limit(5000);
        CRUD::column('created_at')->label('Criado em')->type('datetime');
        CRUD::column('updated_at')->label('Atualizado em')->type('datetime');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TaskRequest::class);
        CRUD::field('title')->label('Título')->required(true);
        CRUD::field('description')->label('Descrição')->type('textarea');
        CRUD::field('is_completed')->label('Concluído')->type('boolean')->default(false);
        CRUD::field('deadline')->label('Prazo')->type('datetime');
        CRUD::field('collaborator_id_sender')->label('Colaborador')->entity('sender')->attribute('name')->model('App\Models\Collaborators');
        CRUD::field('collaborator_id_receiver')->label('Destinatário')->type('select')->entity('receiver')->attribute('name')->model('App\Models\Collaborators');
        CRUD::field('status')->label('Status')->type('text')->default('pending');
        CRUD::field('tag')->label('Tag')->type('text');
        CRUD::field('attachment')->label('Anexos')->type('upload_multiple')->upload(true);
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
