<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResponse\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GetSingleTaskController extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        try {
            $task = Task::with('dependencies')->findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }

        // Users can only see their assigned tasks
        if (Auth::user()->role === 'user' && $task->assigned_to !== Auth::id()) {
            return response()->json([
                'message' => 'You do not have permission to view this task.'
            ], 403);
        }

        return response()->json(new TaskResource($task));
    }
}

