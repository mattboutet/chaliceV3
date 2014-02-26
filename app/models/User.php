<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;
	
	/*public function __construct(array $attributes = array())
	{
		//if the user has selected which template (s)he'd like
		if (Input::has('bare')) {
			$list = Input::get('bare');
		} else {//If they didn't pick one (which they can't until I add to template) just populate pivot with defaults
			
		}
		parent::__construct($attributes);
	}*/

	/**
	 * Returns the user full name, it simply concatenates
	 * the user first and last name.
	 *
	 * @return string
	 */
	public function fullName()
	{
		return "{$this->first_name} {$this->last_name}";
	}
	
	public function beers() {

		return $this->belongsToMany('Beer')->withPivot('checked');//, 'beer_user');//, 'chalice_list_id', 'beer_id');
		//return $this->hasManyThrough('Beer', 'beers_lists', 'list_id', 'beer_id');

	}

}
