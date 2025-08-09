<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'username' => 'required|string|max:255|unique:users,username,' . $this->route('user'),
            'email' => 'required|email:filter|unique:users,email,' . $this->route('user'),
            'mobile_number' => 'required|string|max:11|unique:users,mobile_number,' . $this->route('user'),
        ];
        if(!$this->route('user')) {
            $rules['password'] = 'required|string|min:6';
        }
        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
