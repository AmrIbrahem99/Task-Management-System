<?php
namespace App\Http\Requests\TaskRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'assigned_to.exists' => 'The assigned user must exist in the system.',
            'due_date.date' => 'The due date must be a valid date.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title should not exceed 255 characters.',
        ];
    }
}
