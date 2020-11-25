<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'alias' => $this->alias,
            'phone' => $this->phone,
            'status' => $this->status,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('api.employees.show', $this->id)
                ]
            ]
        ];
    }
}
