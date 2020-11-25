<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\CompanySetting;
use App\Http\Controllers\AppBaseController;

class UserController extends AppBaseController
{
    public function getBootstrap(Request $request)
    {
        $user = Auth::user();

        $company = $request->header('company') ?? 1;

        $currencies = Currency::latest()->get();

        $default_language = CompanySetting::getSetting('language', $company);

        $default_currency = Currency::findOrFail(
            CompanySetting::getSetting('currency', $company)
        );
		
        $moment_date_format = CompanySetting::getSetting(
            'moment_date_format',
            $request->header('company')
        );

        $fiscal_year = CompanySetting::getSetting(
            'fiscal_year',
            $request->header('company')
        );

        // $items = Item::with('taxes')->get();

        // $taxTypes = TaxType::latest()->get();

        return response()->json([
            'user' => $user,
            'currencies' => $currencies,
            'default_currency' => $default_currency,
            'default_language' => $default_language,
            'company' => $user->company_id,
            'companies' => Company::all(),
            'moment_date_format' => $moment_date_format,
            'fiscal_year' => $fiscal_year,
        ]);
    }
}
