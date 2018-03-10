<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReviewsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_reviews_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId', 50);
            $table->string('productId',50);
            $table->string('uploderId',20);
            $table->string('UploderType',5);
            $table->unsignedInteger('parentsId');
            $table->text('comment');
            $table->string('commentOne')->nullable();
            $table->string('commentTwo')->nullable();
            $table->string('commentThree')->nullable();
            $table->string('commentFour')->nullable();
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
        Schema::dropIfExists('product_reviews_comments');
    }
}
