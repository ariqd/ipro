<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sales_order_id');
            $table->unsignedInteger('stock_id');
            $table->integer('qty');
//            $table->float('weight')->nullable();
//            $table->integer('harga_modal');
            $table->integer('price');
            $table->integer('total');
            $table->integer('discount');
//            $table->integer('discount_nominal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_order_details');
    }
}
