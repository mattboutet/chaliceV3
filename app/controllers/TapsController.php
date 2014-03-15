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
		} else {
			//this should maybe be -1 or some sort of special number?
			//$chaliceList = User::find(1)->beers()->get();
		} 	
		
		$matches = array();
		foreach ($taps as $tap){

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

		/*print_r('<pre>');
		print_r($matches);	
		print_r('</pre>');*/
		return View::make('taps.index', compact('taps', 'matches'));
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
