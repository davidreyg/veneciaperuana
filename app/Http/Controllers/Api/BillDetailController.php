<?php

namespace App\Http\Controllers\Api;

use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BillDetailRequest;
use App\Http\Controllers\AppBaseController;

class BillDetailController extends AppBaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BillDetailRequest $request)
    {
        try {
            DB::beginTransaction();

            $campos = $request->validated();
            //CREAMOS LA CABECERA QUE SERIA LA VENTA!
            $venta = Bill::create($campos);
            $detalles = $campos['bill_details'];
            BillDetail::createBillDetails($venta, $detalles);
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
        return Bill::with('bill_details')->whereId($venta->id)->get();
    }
}
