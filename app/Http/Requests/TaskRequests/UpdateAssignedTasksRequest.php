<?php
namespace App\Http\Requests\TaskRequests;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAssignedTasksRequest extends FormRequest
{

    public function authorize(): bool
    {
        $task = $this->route('id');

        $task = Task::findOrFail($task);

        return Auth::id() === $task->assigned_to;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,completed,canceled',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'The task status is required.',
            'status.in' => 'The status must be one of: pending, completed, canceled.',
        ];
    }
}
