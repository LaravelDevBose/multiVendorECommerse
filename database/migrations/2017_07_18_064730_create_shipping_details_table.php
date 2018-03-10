<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->string('houseNo')->nullable();
            $table->string('roadNo')->nullable();
            $table->string('block')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('areaName')->nullable();
            $table->unsignedInteger('areaId')->nullable();
            $table->unsignedInteger('districtId')->nullable();
            $table->unsignedInteger('divisionId')->nullable();
            $table->unsignedInteger('countryId')->nullable();
            $table->string('deliveryAreaId')->nullable();
            $table->string('shippingDetailsOne')->nullable();
            $table->string('shippingDetailsTwo')->nullable();
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
        Schema::dropIfExists('shipping_details');
    }
}
