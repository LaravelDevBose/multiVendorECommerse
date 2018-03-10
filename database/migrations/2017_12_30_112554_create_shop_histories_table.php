<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shopId');
            $table->string('youtubeLink');
            $table->string('shopOwnerName');
            $table->tinyInteger('firstView')->deafult(0);
            $table->tinyInteger('status')->deafult(0);
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
        Schema::dropIfExists('shop_histories');
    }
}
