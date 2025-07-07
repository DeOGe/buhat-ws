<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutExerciseResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'workoutExerciseId' => $this->workout_exercise_id,
      'workoutId' => $this->workout_id,
      'exerciseId' => $this->exercise_id,
      'exerciseOrder' => $this->exercise_order,
    ];
  }
}
