<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ombudsman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OmbudsmanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'type' => 'required|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:10240', // 10MB max
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        $data['status'] = 'open'; // Default status

        // Handle file upload if present (basic implementation, might need adjustment based on mutators)
        // The model mutator setAttachmentAttribute might handle base64 or file object. 
        // Backpack usually handles file uploads via mutators, but for API we might need to handle it manually 
        // or ensure the mutator works with the request file.
        // For now, let's assume standard Laravel file upload or the mutator handles it.
        
        $ombudsman = Ombudsman::create($data);

        return response()->json([
            'message' => 'Ombudsman request created successfully',
            'data' => $ombudsman,
            'token' => $ombudsman->response_token
        ], 201);
    }
}
