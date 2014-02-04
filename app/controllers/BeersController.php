<?php

class BeersController extends BaseController {

	/**
	 * Beer Repository
	 *
	 * @var Beer
	 */
	protected $beer;

	public function __construct(Beer $beer)
	{
		$this->beer = $beer;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$beers = $this->beer->all();
		print_r('<pre>'.PHP_EOL);
		//print_r($beers->toSql());
		print_r(compact('beers'));
		print_r('</pre>'.PHP_EOL);	
		return View::make('beers.index', compact('beers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('beers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Beer::$rules);

		if ($validation->passes())
		{
			$this->beer->create($input);

			return Redirect::route('beers.index');
		}

		return Redirect::route('beers.create')
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
		$beer = $this->beer->findOrFail($id);

		return View::make('beers.show', compact('beer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$beer = $this->beer->find($id);

		if (is_null($beer))
		{
			return Redirect::route('beers.index');
		}

		return View::make('beers.edit', compact('beer'));
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
		$validation = Validator::make($input, Beer::$rules);

		if ($validation->passes())
		{
			$beer = $this->beer->find($id);
			$beer->update($input);

			return Redirect::route('beers.show', $id);
		}

		return Redirect::route('beers.edit', $id)
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
		$this->beer->find($id)->delete();

		return Redirect::route('beers.index');
	}

}
