<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
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
            'course_id' => $this->course->id,
            'course_name' => $this->course->title,
            'rate' => $this->rate,
            'comment' => $this->comment,
            'count_reviews' => $this->course->rate->count(),

        ];
    }
}
