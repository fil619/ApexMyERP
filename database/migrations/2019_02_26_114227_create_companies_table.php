<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{

    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description',200);
            $table->string('address', 300);
            $table->bigInteger('telephone');
            $table->bigInteger('mobile');
            $table->string('gst_no',50);
            $table->string('logo', 200)->nullable();
            $table->dateTime('start_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('end_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
