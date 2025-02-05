<?php

namespace App\Http\Requests\TaskRequests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTaskDependenciesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->user()?->hasRole('admin');
    }
    public function rules(): array
    {
        return [
            'dependencies' => 'required|array',
            'dependencies.*' => 'exists:tasks,id',
        ];
    }

    public function messages(): array
    {
        return [
            'dependencies.required' => 'Dependencies are required.',
            'dependencies.array' => 'Dependencies must be an array.',
            'dependencies.*.exists' => 'Each dependency must be a valid task ID.',
        ];
    }
}
