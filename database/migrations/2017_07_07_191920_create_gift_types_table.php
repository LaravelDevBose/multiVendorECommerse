<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiftTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('giftTitle');
            $table->unsignedInteger('position');
            $table->text('image');
            $table->tinyInteger('publicationStatus');
            $table->string('giftFieldOne')->nullable();
            $table->string('giftFieldTwo')->nullable();
            $table->string('giftFieldThree')->nullable();
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
        Schema::dropIfExists('gift_types');
    }
}
