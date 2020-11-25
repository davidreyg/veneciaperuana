<?php

namespace App\Http\Resources\Employee;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Employee $employee) {
            return (new EmployeeResource($employee));
        });
        return [
            'data' => $this->collection
        ];
    }
}
