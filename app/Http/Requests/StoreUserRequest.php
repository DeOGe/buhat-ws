<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['required', 'nullable', 'max:45', "regex:/^[a-zA-Z0-9\sñÑ\-.']+$/"],
            'first_name' => ['sometimes', 'nullable', 'max:45', "regex:/^[a-zA-Z0-9\sñÑ\-.']+$/"],
            'last_name' => ['sometimes', 'nullable', 'max:45', "regex:/^[a-zA-Z0-9\sñÑ\-.']+$/"],
            'email' => ['required', 'max:190'],
            'password_hash' => ['required', 'max:190', 'min:7'],
            'weight' => ['sometimes'],
            'height' => ['sometimes'],
            'gender' => ['sometimes'],
            'date_of_birth' => ['sometimes'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'account_type' => $this->accountType,
            'contact_number' => $this->contactNumber,
            'profile_image' => $this->profileImage,
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'success' => false,
            'message' =>  $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }
}
