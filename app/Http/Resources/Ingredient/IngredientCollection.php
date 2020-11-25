<?php

namespace App\Http\Resources\Ingredient;

use App\Models\Ingredient;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IngredientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Ingredient $ingredient) {
            return (new IngredientResource($ingredient));
        });
        return [
            'data' => $this->collection
        ];
    }
}
