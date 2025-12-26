<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\News::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/news');
        CRUD::setEntityNameStrings('news', 'news');
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
        CRUD::column('title')->label('Título');
        CRUD::column('slug')->label('Slug');
        CRUD::column('published_at')->label('Data de Publicação');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NewsRequest::class);

        CRUD::field('title')->label('Título')->required(true);
        CRUD::field('slug')->label('Slug')->target('title')->required(true);
        CRUD::field('content')->label('Conteúdo')->type('summernote')->required(true);
        CRUD::field('image')->label('Imagem de Capa')->type('upload')->upload(true)->required(true);
        CRUD::field('photos')->label('Galeria de Fotos')->type('upload_multiple')->upload(true);
        CRUD::field('featured')->label('Destaque');
        CRUD::field('published_at')->label('Data de Publicação')->required(true);
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

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('title')->label('Título');
        CRUD::column('slug')->label('Slug');
        CRUD::column('content')->label('Conteúdo')->type('html');
        CRUD::column('image')->label('Imagem de Capa')->type('image');
        CRUD::column('photos')->label('Galeria de Fotos')->type('upload_multiple');
        CRUD::column('featured')->label('Destaque')->type('check');
        CRUD::column('published_at')->label('Data de Publicação');
        CRUD::column('created_at')->label('Criado em');
        CRUD::column('updated_at')->label('Atualizado em');
    }
}
