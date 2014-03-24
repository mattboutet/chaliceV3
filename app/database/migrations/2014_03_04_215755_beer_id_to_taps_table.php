<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeerIdToTapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('taps', function(Blueprint $table)
		{
			$table->integer('beer_id')->unsigned();
			$table->foreign('beer_id')->references('id')->on('beers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('taps', function(Blueprint $table)
		{
			//
		});
	}

}