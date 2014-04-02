<?php

//use Pintlabs_Service_Untappd\library\Pintlabs\Service\

//MWB FIXME -- this is a super-duper hack.
require_once('/home/chalice/chalice-dev.bigroomstudios.com/vendor/Pintlabs_Service_Untappd/library/Pintlabs/Service/Untappd.php');

class Beer extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'beer_name' => 'required',
		'beer_style' => 'required', 
	);
	
	public function users() {
		
		return $this->belongsToMany('User');
	
	}

			
	/**
     * Searches Untappd's database to find beers matching the query string
     
     * @throws Pintlabs_Service_Untappd_Exception
     */
		
	public static function untappdLookup($search_string) {
   	
        $args = array(
            'q'      => $search_string,
            //'sort'   => $sort
        );

		$config = array(
			'clientId'     => 'F3D8EDF5988F9EC03016605A84AF5B61ABC66D15',
			'clientSecret' => 'C34AC885BAA3AD8218DDB2C5C913291DD1109AC8',
			//'accessToken'  => $accessToken,
			//'redirectUri'  => $redirectUri,
		);
		
		$untappd = new Pintlabs_Service_Untappd($config);
		
		
		try {
			$result = $untappd->beerSearch($search_string);
		} catch (Pintlabs_Service_Untappd_Exception $e) {
			die($e->getMessage());
		}
		
		//if we didn't get a 200 http code, we've got nothing, don't bother.
		if ($result->meta->code != 200){
			return 'No Description Available';
		}
		
		$response = $result->response;
		
		if (is_object($response) && is_object($response->beers)){
			$beers = $response->beers;
		} else {
			return 'No Description Available';
		}
		$matches = $beers->items;
		
		if (is_array($matches)){
			//naive, but just pull first result off array
			$untappd_beer = array_shift($matches);

			
			if (is_object($untappd_beer) && is_object($untappd_beer->beer)) {
				
				if(!empty($untappd_beer->beer->beer_description)){
				
					$description = $untappd_beer->beer->beer_description;
				
					return $untappd_beer->beer->beer_description;
			
				}
			}
		}
		
		return 'No Description Available';
		
    }

	public static function updateDescriptions(){
			
		$beers = Beer::all();
		
		foreach ($beers as $beer){
			if (empty($beer->description)) {

				$desc = Beer::untappdLookup($beer->beer_name);
	
				$beer->description = $desc;
				$beer->save();
	
			}
		}
	}
	
}
