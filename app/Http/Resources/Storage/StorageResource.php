<?php

namespace App\Http\Resources\Storage;

use Illuminate\Http\Resources\Json\JsonResource;

class StorageResource extends JsonResource
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
			'code' => $this->code,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'minimal_stock' => $this->minimal_stock,
            'storageable_id' => $this->storageable_id,
            'storageable_type' => $this->storageable_type,
            'buy_date' => $this->buy_date,
            'provider_id' => $this->provider_id,
			'status' => $this->status,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.providers.show', $this->id)
                ]
            ]
        ];
    }
}
