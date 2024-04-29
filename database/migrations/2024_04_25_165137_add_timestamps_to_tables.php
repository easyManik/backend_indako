<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uom_list,product,product_prices,product_uoms,sell_transaction,sell_transaction_detail', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uom_list,product,product_prices,product_uoms,sell_transaction,sell_transaction_detail', function (Blueprint $table) {
            //
        });
    }
}