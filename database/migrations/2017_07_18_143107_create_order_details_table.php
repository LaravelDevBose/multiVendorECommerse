<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consumerId');
            $table->unsignedInteger('orderId');
            $table->unsignedInteger('ownerId');
            $table->unsignedInteger('productId');
            $table->string('productName');
            $table->unsignedInteger('productPrice');
            $table->unsignedInteger('productQuantity');
            $table->string('sizes')->nullable();
            $table->string('priColor')->nullable();
            $table->string('secColor')->nullable();
            $table->unsignedInteger('subTotal');
            $table->unsignedInteger('subWeight');
            $table->unsignedInteger('status')->default(0);
            $table->tinyInteger('userDemandStatus')->default(0);
            $table->string('userDemandNote')->nullable();
            $table->string('OrDetailsOne')->nullable();
            $table->string('OrDetailsTwo')->nullable();
            $table->string('OrDetailsThree')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
