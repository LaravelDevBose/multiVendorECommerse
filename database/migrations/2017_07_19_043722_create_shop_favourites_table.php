<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->text('userId');
            $table->unsignedInteger('shopId');
            $table->string('shopFvrtOne')->nullable();
            $table->string('shopFvrtTwo')->nullable();
            $table->string('shopFvrtThree')->nullable();
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
        Schema::dropIfExists('shop_favourites');
    }
}
