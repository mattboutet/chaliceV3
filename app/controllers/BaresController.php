<?php

class BaresController extends BaseController {

	/**
	 * Bare Repository
	 *
	 * @var Bare
	 */
	protected $bare;

	public function __construct(Bare $bare)
	{
		$this->bare = $bare;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bares = $this->bare->all();

		return View::make('bares.index', compact('bares'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('bares.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Bare::$rules);

		if ($validation->passes())
		{
			$this->bare->create($input);

			return Redirect::route('bares.index');
		}

		return Redirect::route('bares.create')
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
		$bare = $this->bare->findOrFail($id);

		return View::make('bares.show', compact('bare'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$bare = $this->bare->find($id);

		if (is_null($bare))
		{
			return Redirect::route('bares.index');
		}

		return View::make('bares.edit', compact('bare'));
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
		$validation = Validator::make($input, Bare::$rules);

		if ($validation->passes())
		{
			$bare = $this->bare->find($id);
			$bare->update($input);

			return Redirect::route('bares.show', $id);
		}

		return Redirect::route('bares.edit', $id)
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
		$this->bare->find($id)->delete();

		return Redirect::route('bares.index');
	}

}
