<?php

namespace App\Http\Repositories;
use App\Models\Client;

/**
 * Class ClientRepository
 * @package App\Repositories
 * @version April 10, 2020, 7:21 pm -05
 */

class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Client::class;
    }
}
