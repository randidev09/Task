<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {

		$table->increments('id');
		$table->string('comp_name',45);
		$table->text('address');
		$table->string('phone',20);

        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}