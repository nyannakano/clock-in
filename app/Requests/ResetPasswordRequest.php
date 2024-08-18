<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254', 'exists:users,email'],
            'password' => ['required', 'string', 'confirmed'],
            'pin' => ['required', 'string', 'min:4', 'max:4']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must not be greater than 254 characters',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.confirmed' => 'Password must be confirmed',
            'pin.required' => 'Pin is required',
            'pin.string' => 'Pin must be a string',
            'pin.min' => 'Pin must be 4 characters',
            'pin.max' => 'Pin must be 4 characters',
            'email.exists' => 'Email not found'
        ];
    }
}
