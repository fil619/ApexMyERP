<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvancetakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advancetakens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_id');
            $table->integer('company_id');
            $table->date('date');
            $table->float('amount', 10, 2);
            $table->string('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advancetakens');
    }
}
