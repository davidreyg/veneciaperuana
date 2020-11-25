<?php

namespace App\Observers;

use App\Models\Ingredient;
use App\Models\Storage;

class IngredientObserver
{
    /**
     * Handle the ingredient "created" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function creating(Ingredient $ingredient)
    {
        $nextNumber = Ingredient::getNextIngredientNumber('INGR');
        $ingredient->code = 'INGR-' . $nextNumber;
    }

    /**
     * Handle the ingredient "created" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function created(Ingredient $ingredient)
    {
        $storage = new Storage();
        $storage->storageable_id = $ingredient->id;
        $storage->storageable_type = Ingredient::class;
        $storage->name = $ingredient->name;
        $storage->description = $ingredient->description;
        $storage->code = $ingredient->code;
        $storage->purchase_price = 0;
        $storage->selling_price = 0;
        $storage->minimal_stock = 0;
        $storage->quantity = 0;
        $storage->buy_date = $ingredient->created_at;
        $storage->status = 'C';

        $storage->save();
    }

    /**
     * Handle the ingredient "updated" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function updated(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "deleted" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function deleted(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "restored" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function restored(Ingredient $ingredient)
    {
        //
    }

    /**
     * Handle the ingredient "force deleted" event.
     *
     * @param  \App\Ingredient  $ingredient
     * @return void
     */
    public function forceDeleted(Ingredient $ingredient)
    {
        //
    }
}
