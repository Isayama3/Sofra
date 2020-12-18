<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('phone', 255);
			$table->integer('district_id')->unsigned();
			$table->string('password', 255);
			$table->double('min_price', 8,2);
			$table->double('max_price', 8,2);
			$table->double('delivery_cost', 8,2);
			$table->string('whatsapp', 255);
			$table->string('restaurant_phone');
            $table->enum('status', array('open', 'close'));
            $table->boolean('activation')->default('0');
            $table->string('pin_code')->nullable();
			$table->string('remember_token')->nullable();
			$table->string('api_token', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
