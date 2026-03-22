<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssigneeRequest extends FormRequest
{
    private const ASSIGNEE_TYPES = [
        'person',
        'department',
        'room',
        'project',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'assignee_type' => ['required', 'string', Rule::in(self::ASSIGNEE_TYPES)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'assignee_type' => trim((string) $this->input('assignee_type')),
        ]);
    }
}
