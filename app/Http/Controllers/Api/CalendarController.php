<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::with('collaborator:id,name')->orderBy('start_date', 'asc')->paginate(20));
    }
    public function upcoming()
    {
        return response()->json(Calendar::with('collaborator:id,name')->where('start_date', '>=', now('GMT-3'))->orderBy('start_date', 'asc')->get());
    }
    public function show($id)
    {
        $calendar = Calendar::with('collaborator:id,name')->find($id);

        if (!$calendar) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($calendar);
    }
}
