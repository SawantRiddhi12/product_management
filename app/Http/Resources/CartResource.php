<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'quantity' => $this->quantity,
            'product' => [
                'name' => $this->product->name,
                'price' => $this->product->price,
                'images' => $this->product->images->map(fn($image) => asset('storage/' . $image->path)),
            ],
        ];
    }
}
