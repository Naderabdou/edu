<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transaction_id' => $this['id'],
            'amount_cents' => $this['amount_cents'],
            'currency' => $this['currency'],
            'order' => $this['order'],
            'merchant_order_id' => $this['merchant_order_id'],
            'source_data_sub_type' => $this['source_data_sub_type'],
            'success' => $this['success'],
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
        ];
    }
}
