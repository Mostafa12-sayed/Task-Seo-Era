<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2048',
            'contact_phone_number' => 'required|string|max:11',
        ];
    }

    public function messages(): array
    {
        return [
            'description.max' => 'Description cannot exceed 2KB (2048 characters)',
        ];
    }
}
