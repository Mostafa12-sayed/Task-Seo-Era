<?php
// app/Http/Requests/RegisterRequest.php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
