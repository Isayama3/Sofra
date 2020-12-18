<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('address', 255);
            $table->double('cost', 8,2)->nullable();
            $table->double('delivery_cost', 8,2)->nullable();
			$table->double('total', 8,2)->nullable();
			$table->double('commission', 8,2)->nullable();
			$table->double('net', 8,2)->nullable();
			$table->enum('payment_method', array('cash', 'online'))->nullable();
			$table->enum('status', ['pending','processing','completed','decline','received','delivered'])->default('pending');
			$table->integer('restaurant_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
