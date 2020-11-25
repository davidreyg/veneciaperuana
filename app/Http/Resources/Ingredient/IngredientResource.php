<?php

namespace App\Http\Resources\Ingredient;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
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
            'price' => $this->price,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.ingredients.show', $this->id)
                ]
            ]
        ];
    }
}
