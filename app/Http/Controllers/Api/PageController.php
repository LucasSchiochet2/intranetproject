<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return response()->json(Page::all());
    }

    public function show($slug)
    {
        $page = Page::findBySlug($slug);

        if (!$page) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($page);
    }
}
