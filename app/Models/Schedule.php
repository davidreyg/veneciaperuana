<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Schedule extends Model
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
     *          description="Notes of the Schedule",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="Status of the Schedule (C,U,D)",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="user_id",
     *          description="The id of the User who is buying the Schedule",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Schedule was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Schedule was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */


    public $fillable = [
        'notes',
        'status',
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
        'user_id' => 'integer',
    ];


    public function schedule_dishes()
    {
        return $this->hasMany(ScheduleDish::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
