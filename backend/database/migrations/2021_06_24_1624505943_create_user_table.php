<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {

		$table->increments('id');
		$table->string('username',45);
		$table->string('password');
		$table->string('email',45);
		$table->string('phone',20);
		$table->string('token_auth',64);
		$table->string('verification_code',23);
		$table->integer('email_status',);

        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}