<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('invoice_id');
            $table->morphs('invoiceable');
            $table->timestamps();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
