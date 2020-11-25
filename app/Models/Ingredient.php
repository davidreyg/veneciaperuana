<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Ingredient extends Model
{
    /**
     *
     *      @OA\Property(
     *          property="id",
     *          description="id",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="name",
     *          description="Name of the Ingredient",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="price",
     *          description="Price of the Ingredient",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description short of the Ingredient",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="code",
     *          description="Code short of the Ingredient",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="category_id",
     *          description="The id of the category of the Ingredient",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Ingredient was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Ingredient was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */



    public $fillable = [
        'name',
        'price',
        'description',
        'code'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'name'  => 'string',
        'price'  => 'integer',
        'description' => 'string',
        'code' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|string',
        'price'  => 'required|integer',
        'description' => 'string|size:100',
        'code' => 'string|size:20'
    ];

    public function dish_ingredients()
    {
        return $this->morphMany(DishIngredient::class, 'dishable');
    }

    public function bill_details()
    {
        return $this->morphMany(BillDetail::class, 'billable');
    }

    public static function getNextIngredientNumber($value)
    {
        // Get the last created order
        $lastIngredient = Ingredient::where('code', 'LIKE', $value . '-%')
            ->orderBy('id', 'desc')
            ->first();


        if (!$lastIngredient) {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = explode("-", $lastIngredient->code);
            $number = $number[1];
        }
        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %06d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return sprintf('%06d', intval($number) + 1);
    }
}
