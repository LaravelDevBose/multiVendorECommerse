<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shoppingcart', function (Blueprint $table) {
            $table->increments('id');
            //shopping cart tabel database eer new folder e store ase 
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('shoppingcart');
    }
}
