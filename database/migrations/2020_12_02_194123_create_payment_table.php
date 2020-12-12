<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTable extends Migration {

	public function up()
	{
		Schema::create('payment', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('rest_of_money', 8,2);
			$table->text('notes');
			$table->date('date');
			$table->decimal('money', 8,2);
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('payment');
	}
}