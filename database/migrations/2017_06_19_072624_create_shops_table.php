<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shopViewId');
            $table->string('shopName');
            $table->string('shopSkills')->nullable();
            $table->string('onlineAddress')->nullable();
            $table->string('shopEmail')->nullable();
            $table->text('shopLogo')->nullable() ;
            $table->text('shopTags')->nullable();
            $table->unsignedInteger('status')->nullable();
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
        Schema::dropIfExists('shops');
    }
}
