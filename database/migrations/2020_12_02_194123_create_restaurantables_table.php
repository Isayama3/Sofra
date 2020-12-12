<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantablesTable extends Migration {

	public function up()
	{
		Schema::create('restaurantables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->integer('restaurantable_id');
			$table->string('restaurantable_type');
		});
	}

	public function down()
	{
		Schema::drop('restaurantables');
	}
}