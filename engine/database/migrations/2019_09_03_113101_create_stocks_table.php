<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStocksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stocks', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('item_id')->unsigned();
			$table->integer('branch_id')->unsigned();
			$table->integer('quantity');
			$table->integer('price_branch');
			$table->integer('hold')->default(0);
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
		Schema::drop('stocks');
	}
}
