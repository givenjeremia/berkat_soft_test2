<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddCustomeridColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_orders' , function(Blueprint $table){
            $table->unsignedBigInteger('customers_id');
            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salers_orders' , function (Blueprint $table){
            $table->dropForeign(['customers_id']);
            $table->dropColumn('customers_id');
        });
    }
}
