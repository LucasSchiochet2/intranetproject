<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DocumentsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DocumentsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DocumentsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Documents::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/documents');
        CRUD::setEntityNameStrings('documents', 'documents');

        if (!backpack_user()->can('list documents')) {
            CRUD::denyAccess(['list', 'show']);
        }
        if (!backpack_user()->can('create documents')) {
            CRUD::denyAccess(['create']);
        }
        if (!backpack_user()->can('update documents')) {
            CRUD::denyAccess(['update']);
        }
        if (!backpack_user()->can('delete documents')) {
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
        CRUD::column('category')->label('Categoria');
        CRUD::column('created_at')->label('Criado em');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DocumentsRequest::class);

        CRUD::field('title')->label('Título');
        CRUD::field('document_category_id')->label('Categoria')->type('select')->entity('category')->attribute('name')->model('App\Models\DocumentCategory');
        CRUD::field('description')->label('Descrição')->type('summernote');
        CRUD::field('files')->label('Arquivos')->type('upload_multiple')->upload(true);
    }

    protected function setupShowOperation()
    {
        CRUD::column('title')->label('Título');
        CRUD::column('category')->label('Categoria');
        CRUD::column('description')->label('Descrição')->type('html');
        CRUD::column('files')->label('Arquivos')->type('upload_multiple');
        CRUD::column('created_at')->label('Criado em');
        CRUD::column('updated_at')->label('Atualizado em');
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
