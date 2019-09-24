<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('id');
			$table->bigInteger('customer_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->integer('sales_id')->nullable();
			$table->integer('admin_id')->nullable();
			$table->string('quotation_id', 191);
			$table->string('project', 191);
			$table->string('pic', 191);
			$table->string('send_address', 191);
			$table->string('send_date', 191);
			$table->string('send_pic_phone', 191);
			$table->string('payment_method', 191);
			$table->text('note', 65535);
			$table->date('tgl_pembayaran')->nullable();
			$table->integer('grand_total');
			$table->string('no_so', 191)->nullable();
			$table->string('notes', 191)->nullable();
			$table->string('no_order', 191)->nullable();
            $table->integer('ongkir')->nullable()->default(0);
            $table->boolean('delivery_status')->default(false);
            $table->string('perihal')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
}
