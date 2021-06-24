<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouriteCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('favouriteCompany', function (Blueprint $table) {

		$table->integer('userID',);
		$table->integer('companyID',);

        });
    }

    public function down()
    {
        Schema::dropIfExists('favouriteCompany');
    }
}