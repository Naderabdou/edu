<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Courses\LessonResource;
use App\Http\Resources\Api\QuizResource;

class TopicCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->quiz);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lessons' => LessonResource::collection($this->lessons) ?? null,
        ];
    }
}
