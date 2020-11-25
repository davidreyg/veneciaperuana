<?php

namespace App\Observers;

use App\Models\BillDetail;
use App\Models\Storage;

class BillDetailObserver
{
    /**
     * Handle the bill detail "created" event.
     *
     * @param  \App\BillDetail  $billDetail
     * @return void
     */
    public function created(BillDetail $billDetail)
    {
        // Storage::updateOrCreate(['name' => 'GALLETAS OREO 35g'], ['purchase_price' => 100]);
        $storage = Storage::where('code', $billDetail->code)->first();
        $storage->name = $billDetail->name;
        $storage->description = $billDetail->description;
        $storage->code = $billDetail->code;
        $storage->purchase_price = $billDetail->price;
        // $storage->quantity +=  $billDetail->quantity;
        $storage->increment('quantity', $billDetail->quantity);
        $storage->storageable_id = $billDetail->billable_id;
        $storage->storageable_type = $billDetail->billable_type;
        $storage->provider_id = $billDetail->provider_id;
        $storage->buy_date = $billDetail->created_at;
        $storage->status = 'A';

        $storage->save();
    }

    /**
     * Handle the bill detail "updated" event.
     *
     * @param  \App\BillDetail  $billDetail
     * @return void
     */
    public function updated(BillDetail $billDetail)
    {
        //
    }

    /**
     * Handle the bill detail "deleted" event.
     *
     * @param  \App\BillDetail  $billDetail
     * @return void
     */
    public function deleted(BillDetail $billDetail)
    {
        //
    }

    /**
     * Handle the bill detail "restored" event.
     *
     * @param  \App\BillDetail  $billDetail
     * @return void
     */
    public function restored(BillDetail $billDetail)
    {
        //
    }

    /**
     * Handle the bill detail "force deleted" event.
     *
     * @param  \App\BillDetail  $billDetail
     * @return void
     */
    public function forceDeleted(BillDetail $billDetail)
    {
        //
    }
}
