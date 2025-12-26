<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::orderBy('start_date', 'desc')->paginate(20));
    }

    public function show($id)
    {
        $calendar = Calendar::find($id);

        if (!$calendar) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($calendar);
    }
}
