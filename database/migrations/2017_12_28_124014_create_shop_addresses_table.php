<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shopId')->nullable();
            $table->string('houseNo')->nullable();
            $table->string('roadNo')->nullable();
            $table->string('block')->nullable();
            $table->string('areaName')->nullable();
            $table->unsignedInteger('areaId')->nullable();
            $table->unsignedInteger('districtId')->nullable();
            $table->unsignedInteger('divisionId')->nullable();
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
        Schema::dropIfExists('shop_addresses');
    }
}
