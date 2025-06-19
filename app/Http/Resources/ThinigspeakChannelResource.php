<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThinigspeakChannelResource extends JsonResource
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
            'name' => $this->name,
            'channel_id'=>$this->channel_id,
            'api_read_key' => $this->api_read_key,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
