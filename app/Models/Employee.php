<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Employee extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the Employee",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="alias",
     *      description="alias of the Employee",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="phone",
     *      description="phone just 9 numbers",
     *      type="integer",
     *      format="int32"
     *  ),
     *  @OA\Property(
     *      property="status",
     *      description="status like: created=C, deleted=D",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when Employee was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when Employee was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    public $fillable = [
        'name',
        'alias',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'name'  => 'string',
        'alias' => 'string',
        'phone' => 'integer',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|size:50',
        'alias' => 'string|size:20',
        'phone' => 'numeric|max:999999999',
        'status' => 'string|size:1'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
