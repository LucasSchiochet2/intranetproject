<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return $this->getMenuByKey('main');
    }

    public function main()
    {
        return $this->getMenuByKey('main');
    }

    public function fastaccess()
    {
        return $this->getMenuByKey('fastaccess');
    }

    public function links()
    {
        return $this->getMenuByKey('links');
    }

    private function getMenuByKey($key)
    {
        $items = MenuItem::where('menu_key', $key)
            ->orderBy('lft')
            ->get();

        return response()->json($this->buildTree($items));
    }

    private function buildTree($items)
    {
        $grouped = $items->groupBy('parent_id');

        foreach ($items as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            } else {
                $item->children = [];
            }
        }

        return $items->whereNull('parent_id')->values();
    }
}
