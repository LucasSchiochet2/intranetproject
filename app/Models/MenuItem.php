<?php

namespace App\Models;

use Backpack\MenuCRUD\app\Models\MenuItem as OriginalMenuItem;

class MenuItem extends OriginalMenuItem
{
    protected $fillable = ['name', 'type', 'link', 'page_id', 'parent_id', 'icon'];
}
