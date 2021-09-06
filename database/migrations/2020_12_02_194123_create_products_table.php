<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->double('price', 8,2);
			$table->double('offer_price', 8,2)->nullable();
			$table->integer('time');
			$table->text('description');
			$table->string('pic', 255)->nullable();
			$table->integer('category_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('products');
	}
}
