<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question,
            'quiz_id' => $this->quiz_id,
            'score' => $this->score,
            'answers' => $this->answers->map(function ($answer) {
                return [
                    'id' => $answer->id,
                    'answer' => $answer->answer,
                    'is_correct' => $answer->is_correct,
                ];
            })
        ];
    }
}
