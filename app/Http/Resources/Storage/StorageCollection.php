<?php

namespace App\Http\Resources\Storage;

use App\Models\Storage;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StorageCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Storage $storage) {
            return (new StorageResource($storage));
        });
        return [
            'data' => $this->collection
        ];
    }
}
