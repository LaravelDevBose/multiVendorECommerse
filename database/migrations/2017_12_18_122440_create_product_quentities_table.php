<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductQuentitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_quentities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productId');
            $table->unsignedInteger('sizeId');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('quantityOne')->nullable();;
            $table->unsignedInteger('quantityTwo')->nullable();;
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
        Schema::dropIfExists('product_quentities');
    }
}
