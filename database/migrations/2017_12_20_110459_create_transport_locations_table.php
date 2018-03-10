<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('divisionId')->nullable();
            $table->unsignedInteger('districtId')->nullable();
            $table->unsignedInteger('otherAreaId')->nullable();
            $table->string('areaName');
            $table->string('locationOne')->nullable();
            $table->string('locationTwo')->nullable();
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
        Schema::dropIfExists('transport_locations');
    }
}
