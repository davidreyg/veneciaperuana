<?php

namespace App\Http\Requests;

use App\Http\Utils\APIRequest;

class BillDetailRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $detalles = $this->request->get('bill_details');
        $rules = [
            'tax' =>  'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'sub_total' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'total' =>  'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'notes' =>  'required|string',
            'user_id' => 'required|exists:users,id',
            'bill_details' => 'array|min:1|required',
            'bill_details.*.name' => 'required|string',
            'bill_details.*.description' => 'nullable|string',
            'bill_details.*.code' => 'required|exists:storages,code',
            'bill_details.*.price' => 'required|integer',
            'bill_details.*.quantity' => 'required',
            'bill_details.*.total' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'bill_details.*.provider_id' => 'required|exists:providers,id',
            'bill_details.*.billable_id' => 'required',
            'bill_details.*.billable_type' => 'required|string',
            // 'bill_details.*.purchase_price' => 'required|integer',
            // 'bill_details.*.selling_price' => 'nullable',
            // 'bill_details.*.minimal_stock' => 'nullable',

        ];
        // if ($detalles) {
        //     foreach ($detalles as $i => $value) {
        //         $product = Product::where('id', $detalles[$i]['product_id'])->first();
        //         $stockDisponible = $product->stock;
        //         $rules['bill_details.' . $i . '.quantity'] = "required|lte:4";
        //     }
        // }
        return $rules;
    }
}
