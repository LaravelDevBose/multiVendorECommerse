<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDemandImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_demand_images', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderDetailsId');
            $table->string('userDemandImage');
            $table->string('userDemandImageOne');
            $table->string('userDemandImageTwo');
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
        Schema::dropIfExists('user_demand_images');
    }
}
