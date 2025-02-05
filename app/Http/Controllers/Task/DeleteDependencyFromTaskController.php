<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\DeleteTaskDependenciesRequest;
use App\Http\Resources\TaskResponse\DeleteTaskDependenciesResponse;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DeleteDependencyFromTaskController extends Controller
{
    public function __invoke(DeleteTaskDependenciesRequest $request, int $taskId): JsonResponse
    {
        // Validate if dependencies are provided
        if (empty($request->dependencies)) {
            return response()->json([
                'message' => 'No dependencies provided for deletion.'
            ], 400);
        }

        try {
            $task = Task::findOrFail($taskId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        // Get the task's dependencies
        $taskDependencies = $task->dependencies->pluck('id')->toArray();

        // Check if all requested dependencies are valid
        $invalidDependencies = array_diff($request->dependencies, $taskDependencies);
        if (!empty($invalidDependencies)) {
            return response()->json([
                'message' => 'The following tasks are not dependencies of task ' . $taskId . ': ' . implode(', ', $invalidDependencies)
            ], 400);
        }

        // Detach the dependencies
        DB::transaction(function () use ($task, $request) {
            $task->dependencies()->detach($request->dependencies);
        });

        $task->refresh();

        return response()->json(new DeleteTaskDependenciesResponse($task));
    }
}
