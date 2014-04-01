<?php

/****************
 * This is no longer used.  Keep around in case code needs to be cannibalized, then delete.
 * 
 */
class ChaliceController extends BaseController {

	public function index()
	{
		
		if (Sentry::check()) {
			$user = Sentry::getUser();
			
			$beers = $user->beers()->get();

		} else {
			//this should grab a default user that has a zero'ed out list.
			//for now just grab my user 'cause it's easier and I'm lazy
			$beers = User::find(1)->beers()->get();
		}

		return View::make('frontend/chalice/index', compact('beers'));

	}
	
	public function getTapList()
	{
		
		//require_once('simple_html_dom.php');
		if (Sentry::check()) {
			
			$user = Sentry::getUser();
			
			$chaliceList = $user->beers()->get();
		} else {
			$chaliceList = User::find(1)->beers()->get();
			
		} 		

		$taps = Tap::all();	
		
		foreach ($taps as $tap){

			$search_string = 'http://www.google.com/search?q=site:beeradvocate.com+'.urlencode($tap->tap_name).'&btnI=I';
			$searchtoo = '<a href="'.$tap->tap_link.'">'.$tap->tap_name.'</a>';
			
			if (isset($chaliceList) && isset($tap->beer_id)){

				foreach ($chaliceList as $list_beer){
					
					$beer_name = $list_beer->beer_name;
					$drank = $list_beer->pivot->checked;
					//this may need tweaking to get the right distance 3-4 seems about right.
					if (levenshtein($beer_name, html_entity_decode($tap->tap_name)) < 4 ) {
						if ($drank == 1) {
							$searchtoo = '<a href="'.$tap->tap_link.'" class="drank">'.$tap->tap_name.'</a>';
							break;
						} else {
							$searchtoo = '<a href="'.$tap->tap_link.'" class="notdrank">'.$tap->tap_name.'</a>';
							break;
						} 
					}
				}
			}
					
			$list[] = $searchtoo;
			
		}

		return View::make('tapList')->with('list', $list);

	}

}