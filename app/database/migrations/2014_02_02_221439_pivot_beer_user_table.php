<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotBeerUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beer_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('beer_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('beer_id')->references('id')->on('beers')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('beer_user');
	}

}
