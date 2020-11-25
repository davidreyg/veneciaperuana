<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 50);
            $table->string('description', 100)->nullable();
            $table->integer('purchase_price')->unsigned();
            $table->integer('selling_price')->unsigned();
            $table->integer('minimal_stock')->unsigned();
            $table->string('code')->unique();
            $table->integer('quantity')->unsigned();
            $table->morphs('storageable');
            $table->char('status', 1)->default('C');
            $table->unsignedbigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('restrict');
            $table->timestamp('buy_date')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storages');
    }
}
