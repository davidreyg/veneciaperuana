<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class DishIngredient extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the product/ingredient used in the Dish",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      description="description of the product/ingredient used in the Dish",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="price",
     *      description="price of the product/ingredient used in the Dish",
     *      type="integer",
     *      format="int32"
     *  ),
     *  @OA\Property(
     *      property="quantity",
     *      description="quantity of the product/ingredient used in the Dish",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="total",
     *      description="total of the product/ingredient used in the Dish",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="dishable_id",
     *      description="id of the product/ingredient used in the Dish",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="dishable_type",
     *      description="type of the entity (product/ingredient) used in the Dish",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when product/ingredient used in the Dish was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when product/ingredient used in the Dish was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    protected $fillable = [
        'dish_id',
        'dishable_id',
        'dishable_type',
        'name',
        'description',
        'price',
        'quantity',
        'total'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'integer',
        'quantity' => 'integer',
        'total' => 'integer',
        'dish_id' => 'integer',
        'dishable_id' => 'integer',
        'dishable_type' => 'string'
    ];

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function dishable()
    {
        return $this->morphTo();
    }
}
