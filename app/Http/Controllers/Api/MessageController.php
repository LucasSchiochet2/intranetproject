<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show($id)
    {
        $message = Message::with('collaborators')->findOrFail($id);
        return response()->json($message);
    }

    public function showCollaboratorMessages($collaborator_id)
    {
        $messages = Message::whereHas('collaborators', function ($query) use ($collaborator_id) {
            $query->where('collaborator_id', $collaborator_id);
        })
        ->with('user:id,name')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($message) {
            return [
                'id' => $message->id,
                'title' => $message->title,
                'content' => $message->content,
                'sender' => $message->user->name ?? null,
                'is_read' => $message->collaborators->first()->pivot->is_read ?? false,
            ];
        });

        return response()->json($messages);
    }
    public function markAsRead($id, Request $request)
    {
        $request->validate(['collaborator_id' => 'required|exists:collaborators,id']);

        $message = Message::findOrFail($id);
        $message->collaborators()->updateExistingPivot($request->collaborator_id, [
            'is_read' => true,
            'read_at' => now()
        ]);

        return response()->json(['message' => 'Message marked as read']);
    }
}
