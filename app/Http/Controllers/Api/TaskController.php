<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'nullable|boolean',
            'deadline' => 'nullable|date',
            'collaborator_id_sender' => 'nullable|integer|exists:collaborators,id',
            'collaborator_id_receiver' => 'nullable|integer|exists:collaborators,id',
            'status' => 'nullable|string|max:50',
            'tag' => 'nullable|string|max:100',
            'attachment' => 'nullable|array',
            'attachment.*' => 'file|max:10240',
            'checklist' => 'nullable|array',
            'checklist.*.description' => 'required|string|max:255',
            'checklist.*.is_completed' => 'nullable|boolean',
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

        $task = Task::create($data);

        if ($request->has('checklist')) {
            foreach ($request->checklist as $item) {
                $task->checklistItems()->create($item);
            }
        }

        // Load the checklist items for the response
        $task->load('checklistItems');

        return response()->json([
            'message' => 'Task request created successfully',
            'data' => $task,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'is_completed' => 'sometimes|nullable|boolean',
            'deadline' => 'sometimes|nullable|date',
            'collaborator_id_sender' => 'sometimes|nullable|integer|exists:collaborators,id',
            'collaborator_id_receiver' => 'sometimes|nullable|integer|exists:collaborators,id',
            'status' => 'sometimes|nullable|string|max:50',
            'tag' => 'sometimes|nullable|string|max:100',
            'attachment' => 'sometimes|nullable|array',
            'attachment.*' => 'file|max:10240',
            'checklist' => 'nullable|array',
            'checklist.*.id' => 'nullable|integer|exists:task_checklist_items,id',
            'checklist.*.description' => 'sometimes|string|max:255',
            'checklist.*.is_completed' => 'nullable|boolean',
            'checklist.*._destroy' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task->update($request->except('checklist'));

        if ($request->has('checklist')) {
            foreach ($request->checklist as $item) {
                if (isset($item['id'])) {
                    // Update existing item
                    $checklistItem = $task->checklistItems()->find($item['id']);
                    if ($checklistItem) {
                        if (isset($item['_destroy']) && filter_var($item['_destroy'], FILTER_VALIDATE_BOOLEAN)) {
                            $checklistItem->delete();
                        } else {
                            $checklistItem->update($item);
                        }
                    }
                } else {
                    // Create new item
                    if ((!isset($item['_destroy']) || !filter_var($item['_destroy'], FILTER_VALIDATE_BOOLEAN)) && isset($item['description'])) {
                        $task->checklistItems()->create($item);
                    }
                }
            }
        }

        // Load the checklist items for the response
        $task->load('checklistItems');

        return response()->json([
            'message' => 'Task updated successfully',
            'data' => $task,
        ], 200);
    }
    public function archive($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->is_archived = true;
        $task->save();

        return response()->json([
            'message' => 'Task archived successfully',
            'data' => $task,
        ], 200);
    }
    public function unarchive($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->is_archived = false;
        $task->save();

        return response()->json([
            'message' => 'Task unarchived successfully',
            'data' => $task,
        ], 200);
    }
    public function getArchivedTasks()
    {
        $tasks = Task::with('checklistItems')->where('is_archived', true)->get();
        return response()->json($tasks);
    }
    public function showCollaboratorTasks($collaborator_id)
    {
        $task = Task::with('checklistItems')->where('collaborator_id_receiver', $collaborator_id)->where('is_archived', false)->get();
        return response()->json($task);
    }

    public function showCollaboratorSenderTasks($collaborator_id)
    {
        $task = Task::with('checklistItems')->where('collaborator_id_sender', $collaborator_id)->where('is_archived', false)->get();
        return response()->json($task);
    }
}
