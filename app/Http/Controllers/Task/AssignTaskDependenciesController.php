<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\AssignTaskDependenciesRequest;
use App\Http\Resources\TaskResponse\AssignTaskDependenciesResponse;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class AssignTaskDependenciesController extends Controller
{
    public function __invoke(AssignTaskDependenciesRequest $request, int $taskId): JsonResponse
    {
        try {
            $task = Task::findOrFail($taskId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        if ($request->dependencies && in_array($taskId, $request->dependencies)) {
            return response()->json([
                'message' => 'Task cannot be dependent on itself.'
            ], 400);
        }

        //prevent circular dependencies
        $circularDependencies = Task::find($request->dependencies)->pluck('dependencies')->toArray();
        if (in_array($taskId, $circularDependencies)) {
            return response()->json([
                'message' => 'Circular dependencies are not allowed.'
            ], 400);
        }

        // Sync dependencies without detaching existing ones
        $task->dependencies()->syncWithoutDetaching($request->dependencies);

        // Return response with the updated task and dependencies
        return response()->json(new AssignTaskDependenciesResponse($task));
    }
}
