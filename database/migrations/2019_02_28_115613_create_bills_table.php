<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->integer('customer_id');
            $table->dateTime('started_on');
            $table->dateTime('ended_on')->nullable();
            $table->double('sub_total', 8, 2)->nullable();
            $table->double('gst_total', 8, 2)->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->integer('grand_total')->nullable();
            $table->integer('advance')->nulllable();
            $table->integer('balance')->nulllable();
            $table->integer('paid')->nulllable();
            $table->integer('returnable')->nulllable();
            $table->string('transaction_type')->nulllable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
