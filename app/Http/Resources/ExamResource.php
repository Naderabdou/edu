<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($this->user);

        return [
            'id' => $this->id,
            // 'name' => $this->user->first()->name,
            'quiz_name' => $this->name,
            'user_name' => $this->user->first()->name,//            'Student' => auth()->user()->name,
            'score' => $this->pivot->score,
            'total_score' => $this->pivot->total_score,
            'is_passed' => $this->pivot->is_passed == 1 ? 'Passed' : 'Failed',
            'total_ques' => $this->pivot->total_ques,
            'created_at' => $this->pivot->created_at->format('F d, Y'),
            'updated_at' => $this->pivot->updated_at->format('F d, Y'),
        ];
    }
}
