<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email',100);
            $table->text('avater')->nullable();
            $table->string('phoneNo');
            $table->string('firstName',100)->nullable();
            $table->string('lastName',100)->nullable();
            $table->string('gender',5)->nullable();
            $table->date('birthDate')->nullable();
            $table->string('userFieldOne')->nullable();
            $table->string('userFieldTwo')->nullable();
            $table->string('userFieldThree')->nullable();
            $table->string('password');
            $table->unsignedInteger('userStatus')->default(0);
            $table->boolean('confirmed')->default(0);
            $table->string('token', 254)->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
