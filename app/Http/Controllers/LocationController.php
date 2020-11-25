<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Retrive a list of Countries.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCountries()
    {
        return response()->json([
            'countries' => Country::all()
        ]);
    }
}