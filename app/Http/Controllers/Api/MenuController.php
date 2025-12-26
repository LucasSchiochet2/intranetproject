<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Backpack\MenuCRUD\app\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::getTree();
        return response()->json($menuItems);
    }
}
