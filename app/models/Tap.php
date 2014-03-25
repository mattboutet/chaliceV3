<?php

//hacky, but do I really want to integrate this into Laravel?
require_once('simple_html_dom.php');

class Tap extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'tap_name' => 'required',
		'tap_link' => 'required'
	);
	
	public static function updateTaps(){
			
		$url = "http://novareresbiercafe.com/draught.php";

		$html = file_get_html($url);
		
		$beers = Beer::all();
		Tap::truncate();
		//this loops through everything in the list (200+ beers) for each item on tap (~30 beers)- not very efficient, but once a day isn't bad.
		foreach($html->find('.draughts_reg p') as $e){
			if (strlen(html_entity_decode($e->innertext)) > 2){
				//hacky way of finding actual items and avoiding poorly indicated separators
				if (!strpos($e->innertext, 'Draughts') &&
					!strpos($e->innertext, 'On Draught') &&  
					!strpos($e->innertext, 'On Cask') &&
					!strpos($e->innertext, 'Weak Sauce') &&
					!strpos($e->innertext, 'Bottle Pours') &&
					strlen(html_entity_decode($e->innertext)) > 2) {
					
					$search_string = str_replace(' ', '+', strip_tags($e->innertext));
					
					//this is a hack, but it works ok for now. https://github.com/bannus/novare/blob/master/index.php in the future
					//untappd api is the shizzle - if only they'd give me a key
					
					$search_string = 'http://www.google.com/search?q=site:beeradvocate.com+'.urlencode($search_string).'&btnI=I';
					
					
					$tap =  new Tap;
					$tap->tap_name = strip_tags($e->innertext);
					$tap->tap_link = $search_string;
					
					foreach ($beers as $beer){
						
						$beer_name = $beer->beer_name;
						
						//this may need tweaking to get the right distance 3-4 seems about right.
						if (levenshtein($beer_name, html_entity_decode($e->innertext)) < 4 ) {
							//if we find a match, set it and break out of the loop.
							$tap->beer_id = $beer->id;
							break;		 
						}
					}
					
					$tap->save();

				}
			}
		}
	}
}
