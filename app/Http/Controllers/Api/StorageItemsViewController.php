<?php

namespace App\Http\Controllers\Api;

use App\Models\StorageItemsView;
use App\Http\Controllers\AppBaseController;

class StorageItemsViewController extends AppBaseController
{
    /** @var  storageItemsRepository */
    private $storageItemsRepository;


    public function index()
    {
        // $ingredients = $this->storageItemsRepository->all();
        return StorageItemsView::all();
        // return $this->showAll(new IngredientCollection($ingredients));
    }

    public function show(string $code)
    {
        return StorageItemsView::where('itemCode', $code)->get();
    }
}
