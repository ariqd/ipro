<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryOrdersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_orders', function (Blueprint $table) {
			$table->integer('id', true);
			$table->text('nomor_surat', 65535);
			$table->integer('sales_order_id');
			$table->string('mobil', 191);
			$table->string('plat', 191);
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
		Schema::drop('delivery_orders');
	}
}
