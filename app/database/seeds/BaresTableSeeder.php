<?php

class BaresTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('bares')->truncate();

		$bares = array('beer_ids' => $this->ids());

		// Uncomment the below to run the seeder
		DB::table('bares')->insert($bares);
	}
	
	public function ids(){
		$beer_ids = array();
		for ($i=1; $i<223; $i++) {
			$beer_ids[] = $i;
		}
		return json_encode($beer_ids);
	}
}
