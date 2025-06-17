<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SetResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'setId' => $this->set_id,
      'workoutExerciseId' => $this->workout_exercise_id,
      'setNumber' => $this->set_number,
      'reps' => $this->reps,
      'weight' => $this->weight,
      'time' => $this->time,
      'distance' => $this->distance,
      'notes' => $this->notes,
    ];
  }
}
