<?php

namespace App\Http\Resources\TaskResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteTaskDependenciesResponse extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'task_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'dependencies' => $this->dependencies,
            'message' => 'Deleted added successfully.',
        ];
    }
}
