<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReceiveDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('receive_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('qty_get');
			$table->integer('total_price');
			$table->integer('receive_id')->nullable();
			$table->integer('purchase_detail_id');
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
		Schema::drop('receive_details');
	}

}
