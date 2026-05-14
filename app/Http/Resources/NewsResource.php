<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'description' => $this->description,
            'date' => $this->created_at,
            'status' => $this->status,
            'read_minutes' => $this->read_minutes,
        ];
    }
}
