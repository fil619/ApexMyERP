<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('name', 50)->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('vehicle_no', 50);
            $table->string('gst_no', 50)->nullable();
            $table->dateTime('first_visit');
            $table->dateTime('last_visit');
            $table->integer('visits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
