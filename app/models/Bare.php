<?php

class Bare extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'beer_ids' => 'required'
	);
}
