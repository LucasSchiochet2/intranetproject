<?php

namespace App\Models;

use Backpack\PageManager\app\Models\Page as PageManagerPage;
use App\Traits\BelongsToTenant;

class Page extends PageManagerPage
{
    use BelongsToTenant;
    // You can add your own customizations here
}
