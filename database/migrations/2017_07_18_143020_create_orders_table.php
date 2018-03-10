<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceId')->nullable();
            $table->unsignedInteger('consumerId');
            $table->unsignedInteger('shippingId');
            $table->unsignedInteger('paymentId');
            $table->unsignedInteger('totalProduct');
            $table->unsignedInteger('totalAmmount');
            $table->string('cartWeight')->nullable();
            $table->unsignedInteger('deliveryPrice')->nullable();
            $table->unsignedInteger('customeInfoId')->nullable();
            $table->unsignedInteger('status')->default('0');

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
        Schema::dropIfExists('orders');
    }
}
