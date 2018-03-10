<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userId');
            $table->string('nationalId')->nullable();
            $table->string('houseNo')->nullable();
            $table->string('roadNo')->nullable();
            $table->string('block')->nullable();
            $table->string('areaName')->nullable();
            $table->string('zipCode');
            $table->unsignedInteger('areaId')->nullable();
            $table->unsignedInteger('districtId')->nullable();
            $table->unsignedInteger('divisionId')->nullable();
            $table->unsignedInteger('userDetailsOne')->nullable();
            $table->unsignedInteger('userDetailsTwo')->nullable();
            $table->unsignedInteger('userDetailsThree')->nullable();
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
        Schema::dropIfExists('consumer_details');
    }
}
