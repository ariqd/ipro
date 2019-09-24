<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->bigInteger('user_id')->unsigned();
			$table->string('name', 191);
			$table->text('address', 65535);
			$table->string('phone', 191);
			$table->string('email', 191);
			$table->string('image', 191)->nullable();
			$table->string('pic_name', 191)->nullable();
			$table->string('pic_phone', 191)->nullable();
			$table->string('pic_email', 191)->nullable();
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
		Schema::drop('vendors');
	}

}
