<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrderCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_customer', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBiginteger('products_id')->unsigned();
            $table->unsignedBiginteger('sales_orders_id')->unsigned();

            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('sales_orders_id')->references('id')->on('sales_orders');

            $table->integer('qty')->nullable();
            $table->double('sub_total')->nullable();


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
        Schema::dropIfExists('sales_order_customer');
    }
}
