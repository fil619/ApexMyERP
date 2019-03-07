<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventcalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventcalendars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('company_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->string('title');
            $table->string('type');
            $table->string('start');
            $table->string('end');
            $table->string('allDay');
            $table->string('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventcalendars');
    }
}
