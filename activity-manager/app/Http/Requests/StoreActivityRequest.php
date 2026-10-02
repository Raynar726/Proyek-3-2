<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'code' => ['required', 'string', 'min:3', 'max:20', 'unique:activities,code'],
            'description' => ['nullable', 'string', 'max:1000'],
            'activity_date' => ['required', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => [
                'required',
                Rule::in(['Planned', 'Ongoing', 'Done']),
            ],
        ];
    }
}