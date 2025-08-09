<?php
// app/Http/Requests/LoginRequest.php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'identifier' => 'required|string', // Can be email or mobile
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'identifier.required' => 'Email or mobile number is required',
        ];
    }
}
