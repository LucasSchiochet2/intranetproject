<?php

namespace App\Models;

use Backpack\MenuCRUD\app\Models\MenuItem as OriginalMenuItem;

class MenuItem extends OriginalMenuItem
{
    // use \App\Traits\BelongsToTenant; // ocultado por solicitação
    protected $fillable = ['name', 'type', 'link', 'page_id', 'parent_id', 'icon', 'menu_key', 'tenant_id'];
}
