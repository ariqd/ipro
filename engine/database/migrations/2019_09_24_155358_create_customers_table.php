<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->bigInteger('no_ktp')->nullable()->unique();
			$table->string('npwp', 191)->nullable();
			$table->string('project_owner', 191);
			$table->text('address', 65535);
			$table->string('phone', 191);
			$table->string('fax', 191)->nullable();
			$table->string('email', 191);
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
		Schema::drop('customers');
	}

}
