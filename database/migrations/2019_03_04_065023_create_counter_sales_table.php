<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('part_id')->nullable();
            $table->string('part_name', 200);
            $table->integer('quantity');
            $table->double('sell_mrp');
            $table->integer('gst_percent');
            $table->string('transaction_type');
            $table->integer('advance')->nulllable();
            $table->integer('balance')->nulllable();
            $table->integer('discount')->nulllable();
            $table->integer('paid')->nulllable();
            $table->integer('returnable')->nulllable();
            $table->dateTime('sold_on')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_sales');
    }
}
