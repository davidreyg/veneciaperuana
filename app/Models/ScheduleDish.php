<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class ScheduleDish extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the Dish in the Detail Bill",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      description="description of the Dish in the Detail Bill",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="price",
     *      description="price of the Dish in the Detail Bill",
     *      type="integer",
     *      format="int32"
     *  ),
     *  @OA\Property(
     *      property="quantity",
     *      description="quantity of the Dish in the Detail Bill",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="schedule_id",
     *      description="id of the Dish in the Detail Bill",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="dish_id",
     *      description="id of the Dish in the Detail Bill",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when Dish in the Detail Bill was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when Dish in the Detail Bill was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    protected $fillable = [
        'schedule_id',
        'dish_id',
        'name',
        'description',
        'price',
        'quantity'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'integer',
        'quantity' => 'integer',
        'schedule_id' => 'integer',
        'dish_id' => 'integer',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class);
    }

    public function invoice_detail()
    {
        return $this->morphMany(InvoiceDetail::class, 'invoiceable');
    }
}
