<?php
namespace App\Http\Requests\TaskRequests;

use Illuminate\Foundation\Http\FormRequest;

class AssignTaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public function rules(): array
    {
        return [
            'assigned_to' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'assigned_to.required' => 'Please specify the user to assign the task.',
            'assigned_to.exists' => 'The specified user does not exist.',
        ];
    }
}

