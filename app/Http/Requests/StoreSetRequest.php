<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetRequest extends FormRequest
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
            'workout_exercise_id' => ['required', 'exists:workout_exercises,workout_exercise_id'],
            'set_number'          => ['required', 'integer', 'min:1'],
            'reps'                => ['nullable', 'integer', 'min:0'],
            'weight'              => ['nullable', 'numeric', 'min:0'],
            'time'                => ['nullable', 'regex:/^\d{2}:\d{2}$/'], // e.g., "00:30"
            'distance'            => ['nullable', 'numeric', 'min:0'],
            'notes'               => ['nullable', 'string'],
        ];
    }
}
