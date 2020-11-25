<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->char('status', 1)->default('C');
            $table->string('notes', 100)->nullable();
            $table->unsignedBigInteger('sub_total');
            $table->unsignedBigInteger('tax');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
