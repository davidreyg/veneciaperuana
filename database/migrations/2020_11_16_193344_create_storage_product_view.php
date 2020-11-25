<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageProductView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW storage_products_view AS
        (
            SELECT
            (CASE
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Ingredient' THEN MAX(ingredients.code)
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Product' THEN MAX(products.code)
            END) as itemCode,
            MAX(storages.storageable_type) as itemType,
            MAX(storages.storageable_id) as itemId,
            (CASE
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Ingredient' THEN MAX(ingredients.name)
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Product' THEN MAX(products.name)
            END) as itemName,
            (CASE
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Ingredient' THEN MAX(ingredients.description)
            WHEN MAX(storages.storageable_type) = 'App\\Models\\Product' THEN MAX(products.description)
            END) as itemDescription,
            SUM(storages.quantity) as itemStock,
            MAX(DISTINCT storages.selling_price) as itemPrice
            FROM storages
            INNER JOIN products ON storages.storageable_id = products.id
            INNER JOIN ingredients ON storages.storageable_id = ingredients.id
            GROUP BY storages.code
        )
    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS storage_products_view');
    }
}
