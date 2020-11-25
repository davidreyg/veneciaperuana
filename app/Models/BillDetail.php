<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class BillDetail extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the product/ingredient in the Detail Bill",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      description="description of the product/ingredient in the Detail Bill",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="price",
     *      description="Purchase price of the product/ingredient in the Detail Bill",
     *      type="integer",
     *      format="int32"
     *  ),
     *  @OA\Property(
     *      property="quantity",
     *      description="quantity of the product/ingredient in the Detail Bill",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="total",
     *      description="total of the product/ingredient in the Detail Bill",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="bill_id",
     *      description="id of the Bill in the Detail Bill",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="provider_id",
     *      description="id of the Provider in the Detail Bill",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="billable_id",
     *      description="type of the entity (product/ingredient) in the Detail Bill",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="billable_type",
     *      description="type of the entity (product/ingredient) in the Detail Bill",
     *      type="string",
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when product/ingredient in the Detail Bill was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when product/ingredient in the Detail Bill was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    protected $fillable = [
        'bill_id',
        'billable_id',
        'billable_type',
        'provider_id',
        'name',
        'description',
        'code',
        'price',
        'quantity',
        'total'
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'code' => 'string',
        'price' => 'integer',
        'quantity' => 'integer',
        'total' => 'integer',
        'bill_id' => 'integer',
        'provider_id' => 'integer',
        'billable_id' => 'integer',
        'billable_type' => 'string'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function billable()
    {
        return $this->morphTo();
    }

    public static function createBillDetails($bill, $productsDetail)
    {
        //Loop through sales detalle_ventas
        foreach ($productsDetail as $detail) {

            //Create a new instance of sales detalle_ventas model
            $billDetails = new BillDetail();

            //fill the model properties (mass assignment) with the detail
            $billDetails->fill($detail);

            //Save and link sales billDetails to sales
            $bill->bill_details()->save($billDetails);

            //DESCONTAMOS EL PRODUCTO DE CADA DETALLE DE VENTA
            // $product = Product::findOrFail($data['product_id']);
            // $cantidadADescontar = $data['quantity'];

            // Product::descontarStock($product, $cantidadADescontar);
        }
    }
}
