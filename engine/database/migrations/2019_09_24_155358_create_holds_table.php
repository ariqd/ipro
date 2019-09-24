<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHoldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('holds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('stocks_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('quantity');
			$table->boolean('status');
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
		Schema::drop('holds');
	}

}
