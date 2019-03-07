<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('part_id');
            $table->integer('distributor_id');
            $table->integer('quantity');
            $table->double('buy_mrp', 8, 2);
            $table->double('sell_mrp', 8, 2);
            $table->integer('gst_percent');
            $table->double('buy_gst_value', 8, 2);
            $table->double('buy_value', 8, 2);
            $table->double('sell_gst_value', 8, 2);
            $table->double('sell_value', 8, 2);
            $table->integer('threshold');
            $table->dateTime('bought_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('sold')->nullable();
            $table->dateTime('sold_on')->nullable();
            $table->integer('stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
