<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Storage;

class ProductObserver
{
    /**
     * Handle the ingredient "created" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function creating(Product $product)
    {
        $nextNumber = Product::getNextProductNumber('PROD');
        $product->code = 'PROD-' . $nextNumber;
    }

    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $storage = new Storage();
        $storage->storageable_id = $product->id;
        $storage->storageable_type = Product::class;
        $storage->name = $product->name;
        $storage->code = $product->code;
        $storage->description = $product->description;
        $storage->quantity = 0;
        $storage->purchase_price = 0;
        $storage->selling_price = 0;
        $storage->minimal_stock = 0;
        $storage->buy_date = $product->created_at;
        $storage->status = 'C';

        $storage->save();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
