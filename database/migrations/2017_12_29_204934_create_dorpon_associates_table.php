<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDorponAssociatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorpon_associates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('associatedCode');
            $table->string('name');
            $table->string('phoneNo');
            $table->string('email');
            $table->string('address');
            $table->text('assocImage')->nullable();
            $table->float('assocPersent', 10,2);
            $table->tinyInteger('status')->deafult(0);
            $table->string('assocOne')->nullable();
            $table->string('assocTwo')->nullable();
            $table->string('assocThree')->nullable();
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
        Schema::dropIfExists('dorpon_associates');
    }
}
