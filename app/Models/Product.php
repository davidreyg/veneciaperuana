<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Product extends Model
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
     *          description="Name of the Product",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description short of the Product",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="code",
     *          description="Code of the Product",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="category_id",
     *          description="The id of the category of the Product",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Product was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Product was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */

    public $fillable = [
        'name',
        'description',
        'code',
        'category_id'
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
        'code' => 'string',
        'category_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'  => 'required|string',
        'description' => 'string',
        'code' => 'string',
        'category_id' => 'required|exists:categories,id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoice_details()
    {
        return $this->morphMany(InvoiceDetail::class, 'invoiceable');
    }

    public function bill_details()
    {
        return $this->morphMany(BillDetail::class, 'billable');
    }

    public function dish_ingredients()
    {
        return $this->morphMany(DishIngredient::class, 'dishable');
    }

    public static function descontarStock(Product $product, $descontarStock)
    {
        $product->decrement('stock', $descontarStock);
        $product->save();
    }

    public static function getNextProductNumber($value)
    {
        // Get the last created order
        $lastProduct = Product::where('code', 'LIKE', $value . '-%')
            ->orderBy('id', 'desc')
            ->first();


        if (!$lastProduct) {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = explode("-", $lastProduct->code);
            $number = $number[1];
        }
        // If we have ORD000001 in the database then we only want the number
        // So the substr returns this 000001

        // Add the string in front and higher up the number.
        // the %06d part makes sure that there are always 6 numbers in the string.
        // so it adds the missing zero's when needed.

        return sprintf('%06d', intval($number) + 1);
    }
}
