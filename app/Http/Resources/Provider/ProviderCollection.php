<?php

namespace App\Http\Resources\Provider;

use App\Models\Provider;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProviderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Provider $provider) {
            return (new ProviderResource($provider));
        });
        return [
            'data' => $this->collection
        ];
    }
}
