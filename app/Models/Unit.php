<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema()
 */
class Unit extends Model
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
     *          description="Name of the Unit",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="description",
     *          description="Description short of the Unit",
     *          type="string"
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="When the Unit was created",
     *          type="string",
     *          format="date-time"
     *      ),
     *      @OA\Property(
     *          property="updated_at",
     *          description="When the Unit was updated",
     *          type="string",
     *          format="date-time"
     *      )
     * )
     */
}
