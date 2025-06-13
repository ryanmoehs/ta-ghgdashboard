<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SumberEmisiResource extends JsonResource
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
            'sumber' => $this->sumber,
            'tipe_sumber' => $this->tipe_sumber,
            'kapasitas_output' => $this->kapasitas_output,
            'durasi_pemakaian' => $this->durasi_pemakaian,
            'frekuensi_hari' => $this->frekuensi_hari,
            'unit' => $this->unit,
            'emission_factors' => $this->emission_factors,
            'dokumentasi_url' => $this->dokumentasi ? asset('uploads/sumber_emisi/' . $this->dokumentasi) : null,
            'created_at' => $this->created_at->toDateTimeString(),

            // Memuat relasi jika sudah di-load
            'fuel_properties' => new FuelPropertiesResource($this->whenLoaded('fuel_properties')),
        ];
    }
}
