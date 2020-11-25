<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\InvoiceDetailRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\InvoiceDetail;
use App\Models\Invoice;

class InvoiceDetailController extends AppBaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InvoiceDetailRequest $request)
    {
        try {
            DB::beginTransaction();

            $campos = $request->validated();
            //CREAMOS LA CABECERA QUE SERIA LA VENTA!
            $venta = Invoice::create($campos);
            $detalles = $campos['invoice_products'];
            InvoiceDetail::createInvoiceProductsDetail($venta, $detalles);
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
        return Invoice::with('invoice_details')->whereId($venta->id)->get();
    }
}
