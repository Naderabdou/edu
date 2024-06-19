<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Courses\ratingResource;
use App\Http\Resources\Api\Courses\reviewsResource;
use App\Http\Resources\Api\Courses\InstructorResource;
use App\Http\Resources\Api\Courses\TopicCourseResource;

class CourseShowResource extends JsonResource
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
            'discount' => $this->discount,
            'price_after_discount' => $this->price_after_discount,
            'image' => $this->image_path,
            'rate_avg' => $this->rate_avg,
            'users_count' => $this->users_count,
            'lessons_count' => $this->lessons_count,
            'desc' => $this->desc,
            'requirements' => $this->requirements,
            'topics' => TopicCourseResource::collection($this->topicCourses),
            'instructor' => new InstructorResource($this->instructor),
            'rating' =>new ratingResource($this->rate),
            'review' => reviewsResource::collection($this->rate),
           


        ];
    }
}
