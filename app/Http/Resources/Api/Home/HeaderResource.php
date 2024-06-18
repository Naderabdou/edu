<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeaderResource extends JsonResource
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

            'title' => $this->title,
            'price' => $this->price,
            'image' => $this->image_path,
            'rate' => $this->rate,
            'lessons' => $this->lessons_count,
            'rate_count' => $this->rate_count,
            'users_count' => $this->users_count,
            'instructor' => $this->instructor->name ?? '',

        ];
    }
}
