<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mainCatId');
            $table->string('secondCatId')->nullable();
            $table->string('thirdCatId')->nullable();
            $table->string('fourthCatId')->nullable();
            $table->string('sizeTitle');
            $table->string('details')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('sizeFieldOne')->nullable();
            $table->string('sizeFieldTwo')->nullable();
            $table->string('sizeFieldThree')->nullable();
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
        Schema::dropIfExists('sizes');
    }
}
