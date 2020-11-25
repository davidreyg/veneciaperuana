<?php

namespace App\Http\Requests;

use App\Http\Utils\APIRequest;
use App\Models\Ingredient;

class IngredientRequest extends APIRequest
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
        return Ingredient::$rules;
    }
}
