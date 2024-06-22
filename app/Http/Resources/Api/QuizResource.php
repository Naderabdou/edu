<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use App\Http\Resources\Api\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
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
            'name' => $this->name,
            'time' => $this->time,
            'total_score' => $this->total_score,
            'pass_score' => $this->pass_score,
            'course_id' => $this->course->title,
            'topic_id' => $this->topic->name,
            'questions' => QuestionResource::collection($this->questions),
        ];
    }
}
