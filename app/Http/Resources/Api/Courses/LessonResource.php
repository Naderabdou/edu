<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'video_lesson' => $this->video_lesson_path ?? null,
            'pdf_lesson' => $this->pdf_lesson_path ?? null,
            'desc' => $this->desc,
        ];
    }
}
