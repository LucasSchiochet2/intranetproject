<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        return response()->json(
            Documents::with('category')
                ->where(function($query) {
                    $query->where('collaborator_id', backpack_user()->id)
                          ->orWhereNull('collaborator_id');
                })
                ->latest()
                ->paginate(20)
        );
    }

    public function show($id)
    {
        $document = Documents::with('category')->find($id);

        if (!$document) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($document);
    }

    public function show_by_category($category)
    {
        $documents = Documents::with('category')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category)
                      ->orWhere('slug', $category);
            })
            ->latest()
            ->get();

        return response()->json($documents);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $documents = Documents::where('title', 'like', "%{$query}%")
            ->latest()
            ->get();

        return response()->json($documents);
    }

    public function getCategories()
    {
        $categories = \App\Models\DocumentCategory::all();

        return response()->json($categories);
    }
}
