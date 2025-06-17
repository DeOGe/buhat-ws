<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MuscleResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'muscleId' => $this->muscle_id,
      'name' => $this->name,
      'description' => $this->description,
    ];
  }
}
