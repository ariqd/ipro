<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseDetailsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_details', function (Blueprint $table) {
			$table->integer('id', true);
			$table->integer('item_id');
			$table->integer('total_price');
			$table->integer('qty');
			$table->integer('purchase_price');
			$table->integer('purchase_id');
			$table->integer('approval_finance')->nullable();
			$table->integer('qty_approval')->nullable();
			$table->smallInteger('status')->nullable();
			$table->integer('sales_id')->nullable();
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
		Schema::drop('purchase_details');
	}
}
