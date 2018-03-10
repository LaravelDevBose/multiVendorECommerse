<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shopId');
            $table->text('aboutShop')->nullable();
            $table->text('shippingPolicy')->nullable();
            $table->text('returnPolicy')->nullable(); 
            $table->text('bannerImage')->nullable();
            $table->string('dorponPersent')->nullable();
            $table->tinyInteger('pickUpStatus')->default(0);
            $table->string('shopAreaType')->nullable();
            $table->unsignedInteger('associateId')->nullable();
            $table->unsignedInteger('dorponFriendId')->nullable();
            $table->tinyInteger('qtyCheck')->default(0);
            $table->tinyInteger('publicationCheck')->default(0);
            $table->text('shopDetailsOne')->nullable();
            $table->text('shopDetailsTwo')->nullable();
            $table->text('shopDetailsThree')->nullable();
            $table->text('shopDetailsFour')->nullable(); 
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
        Schema::dropIfExists('shop_details');
    }
}
