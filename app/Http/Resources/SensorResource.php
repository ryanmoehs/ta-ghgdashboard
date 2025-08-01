<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'sensor_name' => $this->sensor_name,
            'field' => $this->field,
            'parameter_name' => $this->parameter_name,
            'unit' => $this->unit,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
