<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArtifactRequest extends FormRequest
{
    private const ARTIFACT_TYPES = [
        'pc',
        'monitor',
        'keyboard',
        'mouse',
        'other',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'artifact_type' => ['required', 'string', Rule::in(self::ARTIFACT_TYPES)],
            'name' => ['required', 'string', 'max:255'],
            'maker' => ['nullable', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'cpu' => ['nullable', 'string', 'max:255'],
            'memory_gb' => ['nullable', 'integer', 'min:1', 'max:2048'],
            'storage_gb' => ['nullable', 'integer', 'min:1', 'max:16384'],
            'display_size' => ['nullable', 'string', 'max:32'],
            'unit_quantity' => ['nullable', 'integer', 'min:1', 'max:1000', 'required_if:artifact_type,pc'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'artifact_type' => $this->input('artifact_type'),
            'name' => trim((string) $this->input('name')),
            'maker' => $this->normalizeNullableString('maker'),
            'model' => $this->normalizeNullableString('model'),
            'cpu' => $this->normalizeNullableString('cpu'),
            'display_size' => $this->normalizeNullableString('display_size'),
            'unit_quantity' => $this->normalizeNullableInteger('unit_quantity'),
        ]);
    }

    private function normalizeNullableString(string $key): ?string
    {
        $value = trim((string) $this->input($key));

        return $value === '' ? null : $value;
    }

    private function normalizeNullableInteger(string $key): ?int
    {
        $value = trim((string) $this->input($key));

        return $value === '' ? null : (int) $value;
    }
}
