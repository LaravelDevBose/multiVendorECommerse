<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transports', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('transportType')->default(1);
            $table->string('transportTitle');
            $table->text('details');
            $table->string('transportTime');
            $table->unsignedInteger('timePeriod');
            $table->float('cartWeight',10,4)->default(1);
            $table->string('areaIds')->nullable();
            $table->float('price',8,2);
            $table->tinyInteger('status');
            $table->tinyInteger('zoneType')->default(1);
            $table->string('transportOne')->nullable();
            $table->string('transportTwo')->nullable();
            $table->string('transportThree')->nullable();
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
        Schema::dropIfExists('product_transports');
    }
}
