<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOrdersResource extends JsonResource
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
            'order_id' => $this->order_number,
            'orderItems' => OrderItemsResource::collection($this->orderItems),
            'status' => $this->status,
            'total_price' => $this->total_price,

            'date' => $this->created_at->format('F j, Y') ?? null,
        ];
    }
}
