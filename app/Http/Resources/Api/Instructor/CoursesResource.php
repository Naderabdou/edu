<?php

namespace App\Http\Resources\Api\Instructor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesResource extends JsonResource
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
            'reviews_count' => $this->rate_count,
            'rate_star' => $this->rate()->avg('rate') ? round($this->rate()->avg('rate')) : 0,
            'price' => $this->price,
            'discount' => $this->discount ? $this->discount : 0,
            'final_price' => $this->price - $this->discount,

        ];
    }
}
