<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->integer('company_id');
            $table->string('name', 100);
            $table->string('manufactured_by', 100);
            $table->string('vehicle_company', 50);
            $table->string('vehicle_model', 50);
            $table->integer('hsn')->nullable();
            $table->integer('sac')->nullable();
            $table->dateTime('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parts');
    }
}
