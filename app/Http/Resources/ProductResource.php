<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return [
                'id'=>$this->id,
                'Product_Name' => $this->Product_Name,
                'description' => $this->description,
                'image' => asset($this->image),
                'category'=> $this->category_id,
                'price'=> $this->price,
            ];
    }
}
