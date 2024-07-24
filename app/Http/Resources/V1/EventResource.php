<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'dt_start' => $this->dt_start,
            'dt_end' => $this->dt_end,
            'dt_start_subscription' => $this->dt_start_subscription,
            'dt_end_subscription' => $this->dt_end_subscription,
            'color' => $this->color
        ];
    }
}
