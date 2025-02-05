<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskController extends Controller
{
    public function __invoke(UpdateTaskRequest $request, int $id): JsonResponse
    {

        try {
            $task = Task::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Task not found.'
            ], 404);

        }

        $validated = $request->validated();

        $task->update($validated);

        return response()->json($task);
    }
}
