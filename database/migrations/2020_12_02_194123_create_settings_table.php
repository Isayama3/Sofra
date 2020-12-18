<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_app');
			$table->integer('app_commission');
			$table->smallInteger('alahly_account_num');
			$table->smallInteger('raghy_account_num');
			$table->string('account_name', 255);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
