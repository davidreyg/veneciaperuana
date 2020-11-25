<?php

namespace App\Http\Requests;

use App\Http\Utils\APIRequest;
use App\Models\Product;

class InvoiceDetailRequest extends APIRequest
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
        $detalles = $this->request->get('invoice_details');
        $rules = [
            'tax' =>  'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'sub_total' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'total' =>  'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'notes' =>  'required|string',
            'user_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id',
            'invoice_details' => 'array|min:1|required',
            'invoice_details.*.name' => 'required|string',
            'invoice_details.*.description' => 'string',
            'invoice_details.*.price' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'invoice_details.*.total' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'invoice_details.*.invoiceable_id' => 'required',
            'invoice_details.*.invoiceable_type' => 'required',


            'invoice_details.*.quantity' => 'required|lte:4',

        ];
        // if ($detalles) {
        //     foreach ($detalles as $i => $value) {
        //         $product = Product::where('id', $detalles[$i]['product_id'])->first();
        //         $stockDisponible = $product->stock;
        //         $rules['invoice_details.' . $i . '.quantity'] = "required|lte:4";
        //     }
        // }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'cliente_id.required' => 'Debe elegir el cliente',
            'cliente_id.exists' => 'El cliente seleccionado no existe en nuestros registros.',
            'invoice_details' => 'No hay detalle',
            'invoice_details.*.price' => 'required|max:9|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/',
            'invoice_details.*.product_id.required' => 'El campo producto es obligatorio',
            'invoice_details.*.quantity.required' => 'El campo quantity es obligatorio',
            'invoice_details.*.price.required' => 'El campo price es obligatorio',
            // 'invoice_details.*.quantity.lte' => 'El campo :attribute debe ser menor que el stock :value',
        ];
        return $messages;
    }
}
