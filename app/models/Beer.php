<?php

class Beer extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'beer_name' => 'required',
		'beer_style' => 'required'
	);
	
	public function users() {
		
		return $this->belongsToMany('User');
	
	}
	
}
