<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

	/**
	 * Indicates if the model should soft delete.
	 *
	 * @var bool
	 */
	protected $softDelete = true;

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
