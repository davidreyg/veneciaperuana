<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class InvoiceDetail extends Model
{
    /**
     *
     *  @OA\Property(
     *      property="name",
     *      description="name of the product in the Detail Invoice",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="description",
     *      description="description of the product in the Detail Invoice",
     *      type="string"
     *  ),
     *  @OA\Property(
     *      property="price",
     *      description="price of the product in the Detail Invoice",
     *      type="integer",
     *      format="int32"
     *  ),
     *  @OA\Property(
     *      property="quantity",
     *      description="quantity of the product in the Detail Invoice",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="total",
     *      description="total of the product in the Detail Invoice",
     *      type="char",
     *  ),
     *  @OA\Property(
     *      property="invoiceable_id",
     *      description="id of the product/ingredient in the Detail Invoice",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="invoiceable_type",
     *      description="type of the entity (product/ingredient) in the Detail Invoice",
     *      type="integer",
     *  ),
     *  @OA\Property(
     *      property="created_at",
     *      description="date when product in the Detail Invoice was created",
     *      type="string",
     *      format="date-time"
     *  ),
     *  @OA\Property(
     *      property="updated_at",
     *      description="date when product in the Detail Invoice was updated",
     *      type="string",
     *      format="date-time"
     *  )
     */

    protected $fillable = [
        'invoice_id',
        'invoiceable_id',
        'invoiceable_type',
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
        'invoice_id' => 'integer',
        'invoiceable_id' => 'integer',
        'invoiceable_type' => 'string'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function invoiceable()
    {
        return $this->morphTo();
    }

    public static function createInvoiceProductsDetail($invoice, $productInvoice)
    {
        //Loop through sales detalle_ventas
        foreach ($productInvoice as $data) {

            //Create a new instance of sales detalle_ventas model
            $product_invoice = new InvoiceDetail;

            //fill the model properties (mass assignment) with the data
            $product_invoice->fill($data);

            //Save and link sales product_invoice to sales
            $invoice->invoice_products()->save($product_invoice);

            //DESCONTAMOS EL PRODUCTO DE CADA DETALLE DE VENTA
            // $product = Product::findOrFail($data['product_id']);
            // $cantidadADescontar = $data['quantity'];

            // Product::descontarStock($product, $cantidadADescontar);
        }
    }
}
