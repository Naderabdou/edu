<?php

namespace App\Http\Resources\Api\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ratingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $percentage = [];
        $totalCount = 0;
        $rate = [1, 2, 3, 4, 5];
        for ($i = 5; $i >= 1; $i--) {
            $count = $this->where('rate', $i)->count();
            $totalCount += $count;
            $percentage['rate ' . $i] = $count;
        }

        foreach ($percentage as $rating => $count) {
            $percentage[$rating] = $totalCount != 0 ? round(($count / $totalCount) * 100, 2) . '%' : '0%';
        }

        return $percentage;
    }
    // private function getRatingLabel($rate)
    // {
    //     switch ($rate) {
    //         case 5:
    //             return 'five';
    //         case 4:
    //             return 'four';
    //         case 3:
    //             return 'three';
    //         case 2:
    //             return 'two';
    //         case 1:
    //             return 'one';
    //     }
    // }
}
