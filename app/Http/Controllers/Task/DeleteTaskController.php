<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
    public function __invoke(int $id): JsonResponse
    {
        // check if task have dependencies
        $task = Task::with('dependencies')->findOrFail($id);
        if ($task->dependencies->count() > 0) {

            //get the dependencies and return a 400 response
            $dependencies = $task->dependencies->pluck('title')->toArray();
            return response()->json([
                'message' => 'Task has dependencies, please delete the dependencies first or update the dependencies.',
                'dependencies' => $dependencies
            ], 400);}

        $task->delete();

        return response()->json(null, 204);
    }
}
