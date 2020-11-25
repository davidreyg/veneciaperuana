<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Dish extends Model
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
     *          description="Name of the Dish",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description short of the Dish",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="price",
     *          description="Retail price of the Dish",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="code",
     *          description="Code of the Dish",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Dish was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Dish was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */


    public $fillable = [
        'name',
        'description',
        'price',
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
        'description' => 'string',
        'price' => 'integer',
        'code' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|size:50',
        'description' => 'string|size:100',
        'code' => 'string|size:100',
        'price' => 'required|numeric',
    ];

    public function schedule_dishes()
    {
        return $this->hasMany(ScheduleDish::class);
    }

    public function dish_ingredients()
    {
        return $this->hasMany(DishIngredient::class);
    }
}
