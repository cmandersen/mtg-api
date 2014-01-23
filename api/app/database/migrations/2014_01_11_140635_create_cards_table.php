<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cards', function(Blueprint $table)
		{
			$table->integer("id")->unique();
			$table->string("name");
			$table->string("mana");
			$table->string("type");
			$table->string("text");
			$table->string("flavor");
			$table->integer("power");
			$table->integer("toughness");
			$table->string("rarity");
			$table->string("image");
			$table->string("color");
			$table->string("set");
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