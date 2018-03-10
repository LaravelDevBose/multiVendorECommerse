<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDorponSupplyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorpon_supplyers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplierCode');
            $table->string('supplier');
            $table->string('ownerName');
            $table->string('supplierPhoneNo');
            $table->string('supplierEmail');
            $table->string('contractPersonName');
            $table->string('contractPhoneNo');
            $table->string('supplierAddress');
            $table->string('productCategory');
            $table->text('supplierImage')->nullable();
            $table->string('status')->deafult(0);
            $table->string('supplierOne')->nullable();
            $table->string('supplierTwo')->nullable();
            $table->string('supplierThree')->nullable();
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
        Schema::dropIfExists('dorpon_supplyers');
    }
}
