<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->data['name_' . app()->getLocale()] ?? null,
            'body'  => $this->data['body_' . app()->getLocale()] ?? null,
            'photo' => $this->data['photo'] ?? asset('dashboard/images/1.png'),
            'date'  => $this->created_at->diffForHumans(),
        ];
    }
}
