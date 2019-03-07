<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('purchase_id')->nullable();
            $table->integer('part_id')->nullable();
            $table->integer('bill_id')->nullable();
            $table->string('part_name', 200);
            $table->integer('quantity');
            $table->double('sell_mrp');
            $table->integer('gst_percent')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
