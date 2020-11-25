<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Bill extends Model
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
     *          property="Notes",
     *          description="Notes of the Bill",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="Status of the Bill (C,U,D)",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="sub_total",
     *          description="Sub total of the Bill",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="total",
     *          description="Total of the Bill",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="tax",
     *          description="Tax of the Bill",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="user_id",
     *          description="The id of the User who is buying the Bill",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Bill was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Bill was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */

    public $fillable = [
        'notes',
        'status',
        'sub_total',
        'total',
        'tax',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'notes'  => 'string',
        'status' => 'string',
        'sub_total' => 'integer',
        'total' => 'integer',
        'tax' => 'integer',
        'user_id' => 'integer',
    ];

    public function bill_details()
    {
        return $this->hasMany(BillDetail::class);
    }
}
