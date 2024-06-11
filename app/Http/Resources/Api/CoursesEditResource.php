<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoursesEditResource extends JsonResource
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
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'slug' => $this->slug_en,
            'image' => $this->image_path,
            'max_students' => $this->max_students,
            'level' => $this->level,
            'is_public' => $this->is_public,
            'is_qa_enabled' => $this->is_qa_enabled,
            'is_content_drip_enabled' => $this->is_content_drip_enabled,
            'content_drip_type' => $this->content_drip_type,
            'type_course' => $this->type_course,
            'start_date' => $this->start_date,
            'language' => $this->language,
            'duration_hours' => $this->duration_hours,
            'duration_minutes' => $this->duration_minutes,
            'tags' => $this->tags,
            'target_audience' => $this->target_audience,
            
            'intro_video' => $this->intro_video,
            'intro_video_type' => $this->intro_video_type,
            'price' => $this->price,
            'discount' => $this->discount,
            'about_ar' => $this->about_ar,
            'about_en' => $this->about_en,
            'requirements_ar' => $this->requirements_ar,
            'requirements_en' => $this->requirements_en,

        ];
    }
}
