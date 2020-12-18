<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('phone', 255);
			$table->integer('district_id')->unsigned();
			$table->string('password', 255);
			$table->boolean('activation')->default('0');
			$table->string('pin_code', 255)->nullable();
			$table->string('remember_token', 255)->nullable();
			$table->string('api_token', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
