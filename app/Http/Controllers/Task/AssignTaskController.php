<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\AssignTaskRequest;
use App\Http\Resources\TaskResponse\AssignTaskResponse;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class AssignTaskController extends Controller
{
    public function __invoke(AssignTaskRequest $request, int $id): JsonResponse
    {

        try {
            $task = Task::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);
        }
        try {
            $user = User::findOrFail($request->assigned_to);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.'
            ], 404);
        }

        if (!$user->hasRole('user')) {
            return response()->json(['message' => 'Can only assign to users'], 400);
        }
        //prevent assigning task to  non-active user
        if (!$user->is_active) {
            return response()->json(['message' => 'Cannot assign task to inactive user'], 400);
        }

        $task->update(['assigned_to' => $user->id]);

        return response()->json(new AssignTaskResponse($task));
    }
}
