<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('percentage')->default(0);
			$table->integer('total_commission')->default(0);
			$table->integer('total_commission_not_achieve')->default(0);
			$table->integer('achievement')->default(0);
			$table->integer('achieved')->nullable()->default(0);
			$table->date('period_start');
			$table->date('period_end');
			$table->string('notes', 191)->nullable();
			$table->softDeletes();
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
		Schema::drop('commissions');
	}

}
