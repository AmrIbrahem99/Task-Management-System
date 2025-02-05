<?php
namespace App\Http\Resources\TaskResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignTaskDependenciesResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'task_id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'dependencies' => $this->dependencies->pluck('id'),
            'message' => 'Dependencies added successfully.',
        ];
    }
}
