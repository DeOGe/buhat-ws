<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkoutExerciseRequest extends FormRequest
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
            'workout_id' => 'sometimes|exists:workouts,workout_id',
            'exercise_id' => 'sometimes|exists:exercises,exercise_id',
            'exercise_order' => 'sometimes|integer|min:1',
        ];
    }
}
