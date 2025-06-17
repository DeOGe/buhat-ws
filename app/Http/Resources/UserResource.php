<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'userId' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'googleId' => $this->google_id,
            'avatar' => $this->avatar,
            'weight' => $this->weight,
            'height' => $this->height,
            'gender' => $this->gender,
            'dateOfBirth' => $this->date_of_birth,
            'createdAt' => Carbon::parse($this->created_at)->format('F d, Y h:i A'),
            'updatedAt' => Carbon::parse($this->updated_at)->format('F d, Y h:i A'),
        ];
    }
}
