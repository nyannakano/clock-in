<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'name' => ['required', 'string', 'max:255'],
            'born_at' => ['required', 'date'],
            'avatar' => ['nullable', 'string'],
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
            'email.max' => 'Email must not be greater than 255 characters',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be a string',
            'password.confirmed' => 'Password must be confirmed',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must not be greater than 255 characters',
            'born_at.required' => 'Born at is required',
            'born_at.date' => 'Born at must be a date',
            'avatar.string' => 'Avatar must be a string',
            'email.unique' => 'Email is already taken',
        ];
    }

}
