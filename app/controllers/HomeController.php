<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

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
		
		//$beers = $this->beer->all();

		return View::make('frontend/chalice/index', compact('beers'));
	}
	
	public function showTapList()
	{
		require_once('simple_html_dom.php');
		if (Sentry::check()) {
			
			$user = Sentry::getUser();
			
			$chaliceList = $user->beers()->get();
		} else {
			$chaliceList = User::find(1)->beers()->get();
			
		} 
		$url = "http://novareresbiercafe.com/draught.php";

		$html = file_get_html($url);
		
		
		//this loops through everything in the list (200+ beers) for each item on tap (~30 beers)- not very efficient
		foreach($html->find('.draughts_reg p') as $e){
			if (strlen(html_entity_decode($e->innertext)) > 2){
				//hacky way of finding actual items and avoiding poorly indicated separators
				if (!strpos($e->innertext, 'Draughts') &&
					!strpos($e->innertext, 'On Draught') &&  
					!strpos($e->innertext, 'On Cask') &&
					!strpos($e->innertext, 'Weak Sauce') &&
					!strpos($e->innertext, 'Bottle Pours') &&
					strlen(html_entity_decode($e->innertext)) > 2) {
					
					$searchstring = str_replace(' ', '+', $e->innertext);
					
					//this is a hack, but it works ok for now. https://github.com/bannus/novare/blob/master/index.php in the future
					//Google API Will let me get the first result always too.
					//http://beeradvocate.com/search?q=searc+terms now works, but will never bring up the #1 result.
					//untappd api is the shizzle
					
					$searchstring = 'http://www.google.com/search?q=site:beeradvocate.com+'.urlencode($searchstring).'&btnI=I';
					$searchtoo = '<a href="'.$searchstring.'">'.$e->innertext.'</a>';
					
					if (isset($chaliceList)){

						foreach ($chaliceList as $beer){
							
							$beer_name = $beer->beer_name;
							$drank = $beer->pivot->checked;
							//this may need tweaking to get the right distance 3-4 seems about right.
							if (levenshtein($beer_name, html_entity_decode($e->innertext)) < 4 ) {
								if ($drank == 1) {
									$searchtoo = '<a href="'.$searchstring.'" class="drank">'.$e->innertext.'</a>';
									break;
								} else {
									$searchtoo = '<a href="'.$searchstring.'" class="notdrank">'.$e->innertext.'</a>';
									break;
								} 
							}
						}
					}
					
					$list[] = $searchtoo;
				} else {
					$list[] = $e->innertext;
				}
			}
		}
	
		return View::make('tap_list')->with('list', $list);

	}

}