<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'workoutId' => $this->workout_id,
      'userId' => $this->user_id,
      'workoutDate' => $this->workout_date,
      'startTime' => $this->start_time,
      'endTime' => $this->end_time,
      'notes' => $this->notes,
    ];
  }
}
