<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:6']
        ];
    }

    public function messages(): array
    {
        return [
            'fullName.required' => 'The fullName field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address',
            'email.unique' => 'The email is already taken',
            'password' => 'The password field is required',
            'password.min' => 'The password must be at least 6 characters'
        ];
    }
}
