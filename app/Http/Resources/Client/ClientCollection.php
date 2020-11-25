<?php

namespace App\Http\Resources\Client;

use App\Models\Client;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Client $client) {
            return (new ClientResource($client));
        });
        return [
            'data' => $this->collection
        ];
    }
}
