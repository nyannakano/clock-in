<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:254', 'exists:users,email'],
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
            'pin.required' => 'Pin is required',
            'pin.string' => 'Pin must be a string',
            'pin.min' => 'Pin must be 4 characters',
            'pin.max' => 'Pin must be 4 characters',
            'email.exists' => 'Email not found'
        ];
    }
}
