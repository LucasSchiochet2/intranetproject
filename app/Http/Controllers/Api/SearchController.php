<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Calendar;
use App\Models\Documents;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Collaborators;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('q');

        if (!$query || strlen(trim($query)) < 2) {
            return response()->json([
                'message' => 'Query must be at least 2 characters',
                'results' => []
            ], 400);
        }

        $query = trim($query);
        $results = [];

        // Search in News
        $newsResults = News::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'slug', 'content', 'published_at'])
            ->map(function ($item) {
                return [
                    'type' => 'news',
                    'id' => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'preview' => substr(strip_tags($item->content), 0, 100) . '...',
                    'published_at' => $item->published_at,
                ];
            });

        // Search in Calendar
        $calendarResults = Calendar::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'description', 'end_date'])
            ->map(function ($item) {
                return [
                    'type' => 'calendar',
                    'id' => $item->id,
                    'title' => $item->title,
                    'preview' => substr($item->description, 0, 100) . '...',
                    'end_date' => $item->end_date,
                ];
            });

        // Search in Documents
        $documentResults = Documents::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'description', 'document_category_id'])
            ->map(function ($item) {
                return [
                    'type' => 'document',
                    'id' => $item->id,
                    'title' => $item->title,
                    'preview' => substr($item->description ?? '', 0, 100) . '...',
                    'category_id' => $item->document_category_id,
                ];
            });

        // Search in Pages
        $pageResults = Page::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'slug', 'content'])
            ->map(function ($item) {
                return [
                    'type' => 'page',
                    'id' => $item->id,
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'preview' => substr(strip_tags($item->content), 0, 100) . '...',
                ];
            });

        // Search in Banners
        $bannerResults = Banner::where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'title', 'description'])
            ->map(function ($item) {
                return [
                    'type' => 'banner',
                    'id' => $item->id,
                    'title' => $item->title,
                    'preview' => substr($item->description ?? '', 0, 100) . '...',
                ];
            });

        // Search in Collaborators
        $collaboratorResults = Collaborators::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('position', 'like', "%{$query}%")
            ->limit(5)
            ->get(['id', 'name', 'position', 'email'])
            ->map(function ($item) {
                return [
                    'type' => 'collaborator',
                    'id' => $item->id,
                    'title' => $item->name,
                    'preview' => $item->position ?? '',
                    'email' => $item->email,
                ];
            });

        // Combine all results
        $allResults = collect()
            ->merge($newsResults)
            ->merge($calendarResults)
            ->merge($documentResults)
            ->merge($pageResults)
            ->merge($bannerResults)
            ->merge($collaboratorResults);

        return response()->json([
            'query' => $query,
            'total' => count($allResults),
            'results' => $allResults->values()->all()
        ]);
    }
}
