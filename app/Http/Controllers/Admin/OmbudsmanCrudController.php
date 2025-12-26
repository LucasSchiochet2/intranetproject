<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OmbudsmanRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OmbudsmanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OmbudsmanCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Ombudsman::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ombudsman');
        CRUD::setEntityNameStrings('ombudsman', 'ombudsmen');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('type')->label('Tipo');
        CRUD::column('subject')->label('Assunto');
        CRUD::column('status')->label('Status');
        CRUD::column('created_at')->label('Data');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OmbudsmanRequest::class);

        CRUD::field('user_id')->label('Usuário');
        CRUD::field('name')->label('Nome');
        CRUD::field('email')->label('Email');
        CRUD::field('type')->label('Tipo')->type('select_from_array')->options(['complaint' => 'Denúncia', 'suggestion' => 'Sugestão', 'compliment' => 'Elogio']);
        CRUD::field('subject')->label('Assunto');
        CRUD::field('message')->label('Mensagem')->type('textarea');
        CRUD::field('attachment')->label('Anexo')->type('upload')->upload(true);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        // Campos apenas para visualização (Read-only)
        CRUD::field('user_id')->label('Usuário')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('name')->label('Nome')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('email')->label('Email')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('type')->label('Tipo')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('subject')->label('Assunto')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('message')->label('Mensagem')->type('textarea')->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);
        CRUD::field('attachment')->label('Anexo')->type('upload')->upload(true)->attributes(['readonly' => 'readonly', 'disabled' => 'disabled']);

        // Campos editáveis
        CRUD::field('status')->label('Status')->type('select_from_array')->options(['open' => 'Aberto', 'in_progress' => 'Em Andamento', 'resolved' => 'Resolvido']);
        CRUD::field('admin_notes')->label('Anotações da Administração')->type('textarea');
        CRUD::field('resolved_at')->label('Resolvido em')->type('date');
    }
}
