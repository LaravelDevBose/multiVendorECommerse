<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sliderTitle');
            $table->string('shortNote');
            $table->string('buttonTitle');
            $table->text('url');
            $table->text('image');
            $table->tinyInteger('publicationStatus');
            $table->string('sliderOne')->nullable();
            $table->string('sliderTwo')->nullable();
            $table->string('sliderThree')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
