<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourcesResource extends JsonResource
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
            'price' => $this->price,
            'discount' => $this->discount,
            'price_after_discount' => $this->price_after_discount,
            'image' => $this->image_path,
            'rate' => $this->rate,
            'users_count' => $this->users_count,
            'lessons_count' => $this->lessons_count,
            'instructor' => $this->instructor->first_name ?? '',
            'desc' => $this->desc,

        ];
    }
}
