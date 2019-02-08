<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quotation_id');
            $table->unsignedInteger('customer_id');
            $table->string('register_id');
            $table->string('project');
            $table->string('project_owner');
            $table->text('address');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->text('send_address');
            $table->date('send_date');
            $table->string('phone_pic');
            $table->text('note');
            $table->string('payment_method');
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
        Schema::dropIfExists('sales');
    }
}
