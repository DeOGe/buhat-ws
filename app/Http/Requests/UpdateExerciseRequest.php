<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'equipment_id' => ['required', 'exists:equipments,equipment_id'],
            'muscle_id' => ['required', 'exists:muscles,muscle_id'],
            'video_url' => ['nullable', 'url'],
        ];
    }
}
