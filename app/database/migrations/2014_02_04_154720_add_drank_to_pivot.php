<?php

use Illuminate\Database\Migrations\Migration;

class AddDrankToPivot extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beer_user', function($table) {
			$table->integer('checked')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('beer_user', function($table) {
			$table->drop_column('checked');
		});
	}

}