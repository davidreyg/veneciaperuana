<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => CategoryResource::make($this->category),
            'category_id' => $this->category->id,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.products.show', $this->id)
                ]
            ]
        ];
    }
}
