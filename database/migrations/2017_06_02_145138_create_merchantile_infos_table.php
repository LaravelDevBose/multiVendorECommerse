<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantileInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchantile_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shopId');
            $table->string('name');
            $table->boolean('gender')->default(0);
            $table->string('email',100)->unique();
            $table->string('phoneNo');
            $table->text('avater')->nullable();
            $table->string('authority');
            $table->string('artisanOne')->nullable();
            $table->string('artisanTwo')->nullable();
            $table->string('artisanThree')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('merchantile_infos');
    }
}
