<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParliamentaryBodyResource extends JsonResource
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
            'slug' => $this->slug,
            'name' => $this->name,
            'brief' => $this->brief,
            'image' => $this->image_url,
            'description' => $this->description,
            'status' => $this->status,
            'date' => $this->created_at,
        ];
    }
}
