<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Storage extends Model
{
    public $timestamps = false;

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
     *          description="Name of the Storage",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description short of the Storage",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="purchase_price",
     *          description="Retail purchase_price of the Storage",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="selling_price",
     *          description="Retail selling_price of the Storage",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="minimal_stock",
     *          description="Retail minimal_stock of the Storage",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="quantity",
     *          description="quantity of the Storage",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="storageable_id",
     *          description="Id of the product/ingredient of the Storage",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="provider_id",
     *          description="Id of the Provider of the Product/Ingredient",
     *          type="integer"
     *      ),
     *      @OA\Property(
     *          property="storageable_type",
     *          description="Type of the product/ingredient of the Storage",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="Status of the product/ingredient of the Storage",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Storage was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Storage was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */


    public $fillable = [
        'name',
        'code',
        'description',
        'quantity',
        'purchase_price',
        'selling_price',
        'minimal_stock',
        'storageable_id',
        'storageable_type',
        'provider_id',
        'buy_date',
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
        'description' => 'string',
        'price' => 'integer',
        'quantity' => 'integer',
        'buy_date' => 'date',
        'storageable_id' => 'integer',
        'provider_id' => 'integer',
        'storageable_type' => 'string',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'minimal_stock'  => 'integer',
        'selling_price' => 'integer',
        'status' => 'string|size:1'
    ];
}
