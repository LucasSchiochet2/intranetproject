<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        return response()->json(Documents::with('category')->latest()->paginate(20));
    }

    public function show($id)
    {
        $document = Documents::with('category')->find($id);

        if (!$document) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($document);
    }
}
