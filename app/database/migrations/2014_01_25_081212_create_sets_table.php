<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sets', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('code');
			$table->string('gatherer_code');
			$table->date('release_date');
			$table->string('border');
			$table->string('type');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sets');
	}

}
