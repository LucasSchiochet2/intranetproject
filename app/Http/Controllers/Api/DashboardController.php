<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dashboards = Dashboard::with(['collaborators', 'tasks'])->get();
        return response()->json($dashboards);
    }

    /**
     * Get the personal dashboard for a collaborator.
     */
    public function personal($id)
    {
        // Verify if collaborator exists
        $collaborator = \App\Models\Collaborators::find($id);

        if (!$collaborator) {
            return response()->json(['message' => 'Collaborator not found'], 404);
        }

        // Get tasks where the collaborator is the receiver
        // Filters: Receiver is the user, and Not Archived
        $tasks = \App\Models\Task::with([
                'collaboratorReceiver',
                'checklistItems',
            ])
            ->where('collaborator_id_receiver', $id)
            ->where('is_archived', false)
            ->get();

        // Construct a "Virtual" Dashboard object
        $dashboard = [
            'id' => 'personal-'.$id,
            'name' => 'Quadro Pessoal',
            'description' => 'Tarefas atribuídas a ' . $collaborator->name,
            'is_personal' => true,
            'tenant_id' => $collaborator->tenant_id ?? null, // optional
            'created_at' => now(),
            'updated_at' => now(),
            'collaborators' => [$collaborator],
            'tasks' => $tasks
        ];

        return response()->json($dashboard);
    }

    /**
     * Get all dashboards that the collaborator belongs to.
     */
    public function getCollaboratorDashboards($id)
    {
        $collaborator = \App\Models\Collaborators::find($id);

        if (!$collaborator) {
            return response()->json(['message' => 'Collaborator not found'], 404);
        }

        $dashboards = $collaborator->dashboards()
            ->with([
                'collaborators',
                'tasks'
            ])
            ->get();

        return response()->json($dashboards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tenant_id' => 'sometimes|integer|exists:tenants,id',
            'collaborators' => 'nullable|array',
            'collaborators.*' => 'integer|exists:collaborators,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $items = $request->only(['name', 'description', 'tenant_id']);

        // Ensure tenant_id is set either from request or from context
        if (!isset($items['tenant_id'])) {
            $items['tenant_id'] = app(\App\Services\TenantManager::class)->getTenantId();
        }

        if (!$items['tenant_id']) {
             return response()->json(['message' => 'Tenant ID is required and could not be resolved.'], 400);
        }

        // If tenant_id is not passed but resolved via middleware, it might be null here if not added to only()
        // But we required it in validation, so it must be present.

        $dashboard = Dashboard::create($items);

        if ($request->has('collaborators')) {
            $dashboard->collaborators()->sync($request->collaborators);
        }

        $dashboard->load('collaborators');

        return response()->json([
            'message' => 'Dashboard created successfully',
            'data' => $dashboard,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dashboard = Dashboard::find($id);

        if (!$dashboard) {
            return response()->json(['message' => 'Dashboard not found'], 404);
        }

        return response()->json($dashboard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dashboard = Dashboard::find($id);

        if (!$dashboard) {
            return response()->json(['message' => 'Dashboard not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'collaborators' => 'nullable|array',
            'collaborators.*' => 'integer|exists:collaborators,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $dashboard->update($request->only(['name', 'description']));

        if ($request->has('collaborators')) {
            $dashboard->collaborators()->sync($request->collaborators);
        }

        $dashboard->load('collaborators');

        return response()->json([
            'message' => 'Dashboard updated successfully',
            'data' => $dashboard,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dashboard = Dashboard::find($id);

        if (!$dashboard) {
            return response()->json(['message' => 'Dashboard not found'], 404);
        }

        $dashboard->delete();

        return response()->json(['message' => 'Dashboard deleted successfully'], 200);
    }
}
