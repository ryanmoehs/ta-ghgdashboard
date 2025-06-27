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
            'report_name' => $this->report_name,
            'period_type' => $this->period_type,
            'period_date' => $this->period_date,
            'category_code' => $this->category_code,
            'total_co2' => $this->total_co2,
            'total_ch4' => $this->total_ch4,
            'total_n2o' => $this->total_n2o,
            'total_pm25' => $this->total_pm25,
            'total_pm10' => $this->total_pm10,
            'avg_co2' => $this->avg_co2,
            'avg_ch4' => $this->avg_ch4,
            'avg_n2o' => $this->avg_n2o,
            'avg_pm25' => $this->avg_pm25,
            'avg_pm10' => $this->avg_pm10,
            'komentar' => $this->komentar,
            'kendala' => $this->kendala,
            'perusahaan_id' => $this->perusahaan_id,
            'sumber_emisi_id' => $this->sumber_emisi_id,
            'sensor_id' => $this->sensor_id,

            // Relasi yang sudah di-load
            'sensor' => new SensorResource($this->whenLoaded('sensor')),
            'sumber_emisi' => new SumberEmisiResource($this->whenLoaded('sumber_emisi')),
            'perusahaan' => new PerusahaanResource($this->whenLoaded('perusahaan')),
        ];
    }
}
