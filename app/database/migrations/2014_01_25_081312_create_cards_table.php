<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cards', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('mana');
			$table->string('type');
			$table->string('text');
			$table->string('flavor');
			$table->integer('power');
			$table->integer('toughness');
			$table->string('rarity');
			$table->string('image');
			$table->string('color');
			$table->integer('set_id')->unsigned();
            $table->foreign('set_id')->references('id')->on('sets');
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
		Schema::drop('cards');
	}

}
