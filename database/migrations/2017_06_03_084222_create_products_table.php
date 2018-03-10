<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('mainCatId');
            $table->unsignedSmallInteger('secondCatId')->nullable();
            $table->unsignedSmallInteger('thirdCatId')->nullable();
            $table->unsignedSmallInteger('fourthCatId')->nullable();
            $table->string('ownerId'); 
            $table->string('productName');
            $table->string('productCode');
            $table->string('productWeight');
            $table->float('discount',10,2)->nullable();
            $table->float('margin',10,2)->nullable();
            $table->unsignedInteger('costPrice')->nullable();
            $table->unsignedInteger('sellPrice')->nullable();
            $table->unsignedInteger('finalPrice');
            $table->string('tagsId')->nullable();
            $table->string('priColorId')->nullable();
            $table->string('secColorId')->nullable();
            $table->string('productVideo')->nullable();
            $table->string('materialsIds')->nullable();
            $table->text('shortDes');
            $table->text('details');
            $table->text('slugs')->nullable();
            $table->string('giftTypeId')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('feature')->nullable();
            $table->tinyInteger('customeStatus')->nullable();
            $table->string('customeMessage')->nullable();
            $table->string('thumbImage')->nullable();
            $table->unsignedInteger('viewStyle')->default(1);
            $table->unsignedInteger('supplierId')->nullable();
            $table->string('productOne')->nullable();
            $table->string('productTwo')->nullable();
            $table->string('productThree')->nullable();
            $table->string('productFour')->nullable();
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
        Schema::dropIfExists('products');
    }
}
