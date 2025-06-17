<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'equipmentId' => $this->equipment_id,
      'name' => $this->name,
      'description' => $this->description,
    ];
  }
}
