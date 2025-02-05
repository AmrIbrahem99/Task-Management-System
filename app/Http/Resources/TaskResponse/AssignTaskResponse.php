<?php
namespace App\Http\Resources\TaskResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignTaskResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'task_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'assigned_to' => [
                'id' => $this->assignee->id,
                'name' => $this->assignee->name,
                'email' => $this->assignee->email,
            ],
            'message' => 'Task assigned successfully.',
        ];
    }
}

