<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->id())
            ],
            'password' => ['sometimes', 'string', 'min:8'],
            'avatar' => ['sometimes', 'url'],
            'google_id' => ['sometimes', 'string', 'nullable'],
            'weight' => ['sometimes', 'numeric', 'min:0'],
            'height' => ['sometimes', 'numeric', 'min:0'],
            'gender' => ['sometimes', 'in:male,female,other'],
            'date_of_birth' => ['sometimes', 'date', 'before:today'],
        ];
    }
}
