<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'year' => $this->year,
            'month' => $this->month,
            'period_type' => $this->period_type,
            'category_code' => $this->category_code,
            'gas_type' => $this->gas_type,
            'total_emission_ton' => $this->total_emission_ton,
            'kendala' => $this->kendala,
            'perusahaan_id' => $this->perusahaan_id,
        ];
    }
}
