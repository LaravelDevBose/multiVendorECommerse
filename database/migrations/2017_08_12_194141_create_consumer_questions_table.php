<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumerQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ownerId')->nullable();
            $table->string('productId')->nullable();
            $table->string('qusenId')->nullable();
            $table->string('userStatus')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('message');
            $table->string('status')->default(0);
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
        Schema::dropIfExists('consumer_questions');
    }
}
