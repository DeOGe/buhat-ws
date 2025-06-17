<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutExerciseResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'workoutId' => $this->workout_id,
      'exerciseId' => $this->exercise_id,
      'exerciseOrder' => $this->exercise_order,
    ];
  }
}
