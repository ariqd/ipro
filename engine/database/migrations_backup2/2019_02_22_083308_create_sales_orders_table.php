<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('customer_id'); // Register ID
            $table->unsignedBigInteger('user_id'); // Project Owner
            $table->string('quotation_id');
            $table->string('project');
//            $table->string('project_owner');
            $table->string('send_address');
            $table->string('send_date');
            $table->string('send_pic_phone');
            $table->string('payment_method');
            $table->text('note');

//            $table->foreign('customer_id')
//                ->references('id')->on('customers');

//            $table->foreign('user_id')
//                ->references('id')->on('users');

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
        Schema::dropIfExists('sales_orders');
    }
}
