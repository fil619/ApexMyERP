<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->longText('address');
            $table->bigInteger('telephone')->nullable();
            $table->bigInteger('mobile');
            $table->string('email')->nullable();
            $table->string('aadhaar')->nullable();
            $table->string('type');
            $table->string('password')->nullable();
            $table->date('joined_on');
            $table->date('left_on')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
