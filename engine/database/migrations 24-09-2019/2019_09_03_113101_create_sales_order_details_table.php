<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('sales_order_id')->unsigned();
			$table->integer('stock_id')->unsigned();
			$table->integer('qty');
			$table->integer('qty_kirim')->default(0);
			$table->integer('price');
			$table->integer('total');
			$table->integer('discount');
			$table->integer('status')->nullable()->default(0);
			$table->integer('komisi_achieve')->default(0);
			$table->integer('komisi_not_achieve')->default(0);
			$table->string('notes', 191)->nullable();
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
		Schema::drop('sales_order_details');
	}
}
