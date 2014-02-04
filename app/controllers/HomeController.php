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
			
			//Illuminate\Database\Eloquent\Relations\BelongsToMany Object
			$beers = $user->beers();
			
			/*print_r('<pre>'.PHP_EOL);
			print_r($beers->toSql());
			//print_r(compact('beers'));
			print_r('</pre>'.PHP_EOL);
			
			$beers = Sentry::find(1)->beers();
			print_r('<pre>'.PHP_EOL);
			print_r($beers->toSql());
			print_r(compact('beers'));
			print_r('</pre>'.PHP_EOL);
			*/
		} else {
			//this should grab a default user that has a zero'ed out list.
			die('bar');
		}
		
		//$beers = $this->beer->all();

		return View::make('frontend/chalice/index', compact('beers'));
	}
	
	public function showTapList()
	{
		return View::make('hello');
	}

}