<?php

class TapsController extends BaseController {

	/**
	 * Tap Repository
	 *
	 * @var Tap
	 */
	protected $tap;

	public function __construct(Tap $tap)
	{
		$this->tap = $tap;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
		$taps = $this->tap->all();
		
		if (Sentry::check()) {
			
			$user = Sentry::getUser();
			
			$chaliceList = $user->beers()->get();
			
		}
		
		$matches = array();
		
		//this sort of makes my eyes bleed, but it doesn't look like sortBy supports order specification
		//Ok, this is horrible.  I'm so sorry.
		$taps = $taps->sortBy((function($tap)
			{
				if (Sentry::check()) {
			
					$user = Sentry::getUser();	
					$chaliceList = $user->beers()->get();
					
					$beer = $chaliceList->find($tap->beer_id);
					if (is_object($beer)){
						return ($beer->pivot->checked == 0)  ? $tap->beer_id : 0;
					} else {
						return 0;
					}
				
				} else {
					return $tap->beer_id;
				}
			}
		))->reverse();
		
		
		foreach ($taps as $i => $tap){
			//$description = Beer::untappdLookup($tap->tap_name);

			//if we have a chalice list and the beer we're looking at has a nonzero beer_id, check to see if it's on the list
			if (isset($chaliceList) && $tap->beer_id){
				
				foreach ($chaliceList as $list_beer){
				
					$beer_name = $list_beer->beer_name;
					$drank = $list_beer->pivot->checked;
					
					if ($tap->beer_id == $list_beer->id){
						$matches[$list_beer->id] = $drank;
					}
				}
			}
		}

		return View::make('frontend/taps.index', compact('taps', 'matches'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('taps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tap::$rules);

		if ($validation->passes())
		{
			$this->tap->create($input);

			return Redirect::route('taps.index');
		}

		return Redirect::route('taps.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tap = $this->tap->findOrFail($id);

		return View::make('taps.show', compact('tap'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tap = $this->tap->find($id);

		if (is_null($tap))
		{
			return Redirect::route('taps.index');
		}

		return View::make('taps.edit', compact('tap'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Tap::$rules);

		if ($validation->passes())
		{
			$tap = $this->tap->find($id);
			$tap->update($input);

			return Redirect::route('taps.show', $id);
		}

		return Redirect::route('taps.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->tap->find($id)->delete();

		return Redirect::route('taps.index');
	}

}
