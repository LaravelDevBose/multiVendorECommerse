<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDorponFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorpon_friends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('friendCode');
            $table->string('name');
            $table->string('phoneNo');
            $table->string('email');
            $table->string('address');
            $table->text('friendImage')->nullable();
            $table->string('status')->deafult(0);
            $table->string('friendOne')->nullable();
            $table->string('friendTwo')->nullable();
            $table->string('friendThree')->nullable();
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
        Schema::dropIfExists('dorpon_friends');
    }
}
