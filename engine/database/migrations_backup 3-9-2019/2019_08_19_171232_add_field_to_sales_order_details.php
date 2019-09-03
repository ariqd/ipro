<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToSalesOrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_order_details', function (Blueprint $table) {
            $table->integer('komisi_achieve');
            $table->integer('komisi_achieve_admin');
            $table->integer('komisi_achieve_referal');
            $table->integer('komisi_not_achieve');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_order_details', function (Blueprint $table) {
            $table->dropColumn('komisi_achieve');
            $table->dropColumn('komisi_achieve_admin');
            $table->dropColumn('komisi_achieve_referal');
            $table->dropColumn('komisi_not_achieve');
        });
    }
}
