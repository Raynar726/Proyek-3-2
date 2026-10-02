<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'activity_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required', 'string', 'max:30', Rule::unique('activities', 'code')->ignore($this->route('activity'))],
            'status' => [
                'required',
                Rule::in(['Planned', 'Ongoing', 'Done']),
            ],
        ];
    }
}