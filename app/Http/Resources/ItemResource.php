<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = Product::find($this->product_id);

        return [
            'product' => [
                "id" => $product->id,
                "name" => $product->name,
                "img_url" =>  $product->img_url,
                "price" =>  $product->price
            ],
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
