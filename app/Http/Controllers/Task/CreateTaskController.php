<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\CreateTaskRequest;
use App\Http\Resources\TaskResponse\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class CreateTaskController extends Controller
{
    public function __invoke(CreateTaskRequest $request): JsonResponse
    {
        // Validate and create task
        $validated = $request->validated();

        $task = Task::create($validated);

        // Return response using TaskResource
        return response()->json(new TaskResource($task), 201);
    }
}
