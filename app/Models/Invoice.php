<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Invoice extends Model
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
     *          description="Notes of the invoice",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="status",
     *          description="Status of the invoice (C,U,D)",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="sub_total",
     *          description="Sub total of the invoice",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="total",
     *          description="Total of the invoice",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="tax",
     *          description="Tax of the invoice",
     *          type="integer",
     *          format="int32"
     *      ),
     *      @OA\Property(
     *          property="client_id",
     *          description="The id of the Client of the Invoice",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="user_id",
     *          description="The id of the User who is selling the Invoice",
     *          type="int",
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the invoice was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the invoice was updated",
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
        'client_id'
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
        'client_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'notes'  => 'string|size:100',
        'status' => 'string|size:1',
        'sub_total' => 'integer',
        'total' => 'integer',
        'tax' => 'integer',
        'user_id' => 'integer|exists:users,id',
        'client_id' => 'string|exists:clients,id'
    ];

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static function getNextInvoiceNumber($value)
    {
        // Get the last created order
        $lastOrder = Invoice::where('invoice_number', 'LIKE', $value . '-%')
            ->orderBy('created_at', 'desc')
            ->first();


        if (!$lastOrder) {
            // We get here if there is no order at all
            // If there is no number set it to 0, which will be 1 at the end.
            $number = 0;
        } else {
            $number = explode("-", $lastOrder->invoice_number);
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
