<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\GetAllTasksRequest;
use App\Http\Resources\TaskResponse\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class GetAllTasksController extends Controller
{
    public function __invoke(GetAllTasksRequest $request): JsonResponse
    {
        $query = Task::query();


        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        if ($request->has('due_date')) {
            $query->whereDate('due_date', '<=', $request->due_date);
        }
        if ($request->has('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        // Users can only see their own tasks
        if (Auth::user()->role === 'user') {
            $query->where('assigned_to', Auth::id());
        }

        return response()->json(TaskResource::collection($query->get()));
    }
}
