<?php namespace Controllers\Account;

use AuthorizedController;
use Input;
use Redirect;
use Sentry;
use Validator;
use View;

class ProfileController extends AuthorizedController {

	/**
	 * User profile page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Get the user information
		$user = Sentry::getUser();
			
		// Show the page
		return View::make('frontend/account/profile', compact('user'));
	}

	/**
	 * User profile form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name'  => 'required|min:3',
			'website'    => 'url',
			'gravatar'   => 'email',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Grab the user
		$user = Sentry::getUser();

		// Update the user information
		$user->first_name = Input::get('first_name');
		$user->last_name  = Input::get('last_name');
		$user->website    = Input::get('website');
		$user->country    = Input::get('country');
		$user->gravatar   = Input::get('gravatar');
		$user->save();

		// Redirect to the settings page
		return Redirect::route('profile')->with('success', 'Account successfully updated');
	}
	
		/**
	 * User profile page.
	 *
	 * @return View
	 */
	public function getList()
	{
		// Get the user information
		$user = Sentry::getUser();
			
		$chaliceList = $user->beers()->get();

		// Show the page
		return View::make('frontend/account/edit-list', compact('user', 'chaliceList'));
	}

	/**
	 * User profile form processing page.
	 *
	 * @return Redirect
	 */
	public function postList()
	{

		// Grab the user
		$user = Sentry::getUser();
		$chalice_list = $user->beers()->get();

		$checked = Input::get('checked');
		
		/*
		 * because of the way html checkboxes work, unchecking something won't submit a value.  to get
		 * around this, I go through the whole loop, check everything that's checked and uncheck the rest
		 * inefficient, but works.  
		 * 
		 * TODO: This is slow as hell.  There has to be a better way.
		 */
		foreach ($chalice_list as $list_beer){
				
			if (in_array($list_beer->id, $checked)){
				
				$user->beers->find($list_beer->id)->pivot->checked = 1;
			} else {
				$user->beers->find($list_beer->id)->pivot->checked = 0;
			}
			$user->beers->find($list_beer->id)->pivot->save();
			
		}
	
		// Redirect to the settings page
		return Redirect::route('edit-list')->with('success', 'List successfully updated');
	}
	

}
