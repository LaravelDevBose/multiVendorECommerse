<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_credentials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sizeId')->nullable();
            $table->string('sizeFileName');
            $table->string('sizeData');
            $table->string('sizeCreOne')->nullable();
            $table->string('sizeCreTwo')->nullable();
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
        Schema::dropIfExists('size_credentials');
    }
}
