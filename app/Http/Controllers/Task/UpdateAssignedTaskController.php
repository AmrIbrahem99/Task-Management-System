<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\UpdateAssignedTasksRequest;
use App\Http\Resources\TaskResponse\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UpdateAssignedTaskController extends Controller
{
    public function __invoke(UpdateAssignedTasksRequest $request, int $id): JsonResponse
    {


        try {
            $task = Task::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        // Ensure that the user is the one assigned to the task
        if (Auth::id() !== $task->assigned_to) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validated();

        // Ensure dependencies are completed before allowing status update to 'completed'
        if ($validated['status'] === 'completed') {
            foreach ($task->dependencies as $dependency) {
                if ($dependency->status !== 'completed') {
                    return response()->json([
                        'message' => 'Cannot complete task until all dependencies are completed'
                    ], 400);
                }
            }
        }

        $task->update(['status' => $validated['status']]);

        return response()->json(new TaskResource($task), 200);
    }
}
