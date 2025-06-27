<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerusahaanResource extends JsonResource
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
            'alamat' => $this->alamat,
            'provinsi' => $this->provinsi,
            'kab_kota' => $this->kab_kota,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'no_telp' => $this->no_telp,
            'kode_pos' => $this->kode_pos,
            'penanggung_jawab' => $this->penanggung_jawab,
            'no_hp' => $this->no_hp,
            'jabatan' => $this->jabatan,
            'email' => $this->email,
            'nama' => $this->nama,
            'sumber_emisis' => SumberEmisiResource::collection($this->whenLoaded('sumber_emisis'))
        ];
    }
}
