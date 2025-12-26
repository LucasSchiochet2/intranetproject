<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each private method in this trait will be interpreted as a page template.
    |
    */

    private function standard()
    {
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Content',
            'type' => 'summernote',
            'placeholder' => 'Your content here...',
        ]);
    }
}
