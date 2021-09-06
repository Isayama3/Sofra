<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTable extends Migration {

	public function up()
	{
		Schema::create('payment', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('restaurant_sales');
            $table->integer('app_commission');
            $table->double('rest_of_money', 8,2)->nullable();
            $table->integer('paid_money')->nullable();
			$table->text('notes')->nullable();
			$table->date('date')->nullable();
			$table->integer('restaurant_id')->unsigned();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('payment');
	}
}
