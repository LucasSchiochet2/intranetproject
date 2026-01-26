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
                ->whereNull('collaborator_id')
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
            ->where(function($q) use ($category) {
                $q->where('document_category_id', $category)
                  ->orWhereHas('category', function($cat) use ($category) {
                      $cat->where('slug', $category);
                  });
            })
            ->whereNull('collaborator_id')
            ->latest()
            ->get();

        return response()->json($documents);
    }

    public function collaboratorDocuments($collaboratorId)
    {
        $documents = Documents::with('category')
            ->where('collaborator_id', $collaboratorId)
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
