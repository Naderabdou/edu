<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class wishlistResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug_en,
            'image' => $this->image_path,
            'user_count' => $this->users_count,
            'lessons_count' => $this->lessons_count,
            'reviews' => $this->rate_count,
            'rate_star' => round($this->rate),
            'price' => $this->price,
            'discount' => $this->discount ? $this->discount : 0,
            'final_price' => $this->price - $this->discount ,


        ];
    }
}
