<?php

namespace App\Http\Resources;

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
            "id"=> $this->id,
            'title' => $this->title,
            'image' => $this->image_url,
            'video' => $this->video_url,
            'date' => $this->date,
            'address' => $this->address,
            'description' => $this->description,
            'rules' => $this->rules,
            'status' => $this->status,
            'chat_available' => $this->chat_available,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location_url' => $this->location_url,
            'organizers' => $this->whenLoaded('organizers'),
            'sponsors' => $this->whenLoaded('sponsors'),
        ];
    }
}
