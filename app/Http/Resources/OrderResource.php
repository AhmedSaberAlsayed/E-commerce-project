<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'product_id'=>$this->product_id,
            'quantity'=>$this->quantity,
            'price'=>$this->price,
            'product_title'=>$this->product_title,
            'TransactionID'=>$this->TransactionID,
            'payment_status'=>$this->payment_status,
        ];
    }
}
