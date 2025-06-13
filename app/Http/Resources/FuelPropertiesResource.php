<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelPropertiesResource extends JsonResource
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
            'fuel_type' => $this->fuel_type,
            'unit' => $this->unit,
            'conversion_factor' => $this->conversion_factor,
            'co2_factor' => $this->co2_factor,
            'ch4_factor' => $this->ch4_factor,
            'n2o_factor' => $this->n2o_factor,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
