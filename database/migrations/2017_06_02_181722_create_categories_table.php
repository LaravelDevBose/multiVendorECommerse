<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mainCatId')->nullable();
            $table->unsignedInteger('secondCatId')->nullable();
            $table->unsignedInteger('thirdCatId')->nullable();
            $table->string('categoryName');
            $table->unsignedInteger('position');
            $table->string('promotionCode')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('publicationStatus');
            $table->string('catFOne')->nullable();
            $table->string('catFTwo')->nullable();
            $table->string('catFthree')->nullable();
            $table->string('catFfour')->nullable();
            $table->string('catFfive')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
