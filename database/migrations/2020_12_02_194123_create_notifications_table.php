<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 255);
			$table->string('content', 255);
			$table->integer('notifiable_id')->unsigned();
			$table->string('notifiable_type',255);
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
