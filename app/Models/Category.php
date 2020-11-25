<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Category extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the Category",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      description="description of the Category",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when Category was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when Category was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    public $fillable = [
        'name',
        'description',
    ];

    /**
     * The attributes that should be casted to native Category.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'name'  => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required',
        'description' => 'string'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
