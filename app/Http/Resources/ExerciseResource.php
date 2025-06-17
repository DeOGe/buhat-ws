<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'exerciseId' => $this->exercise_id,
      'name' => $this->name,
      'description' => $this->description,
      'categoryId' => $this->category_id,
      'equipmentId' => $this->equipment_id,
      'muscleId' => $this->muscle_id,
      'videoUrl' => $this->video_url,
    ];
  }
}
