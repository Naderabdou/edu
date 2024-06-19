<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorResource extends JsonResource
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
            'avatar' => $this->avatar_path,
            'bio' => $this->bio,
            'courses_count' => $this->courses->count(),
            'facebook' => $this->facebook ?? '',
            'twitter' => $this->twitter ?? '',
            'linkedin' => $this->linkedin ?? '',
            'github' => $this->github ?? '',
            'website' => $this->website ?? '',

        ];
    }
}
