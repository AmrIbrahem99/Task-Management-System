<?php
namespace App\Http\Requests\TaskRequests;

use Illuminate\Foundation\Http\FormRequest;

class GetAllTasksRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'nullable|string|in:pending,completed,canceled',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Invalid task status provided.',
            'due_date.date' => 'Due date must be a valid date.',
            'assigned_to.exists' => 'The assigned user does not exist.',
        ];
    }
}
