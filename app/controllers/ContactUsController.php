<?php

class ContactUsController extends BaseController {

	/**
	 * Contact us page.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		return View::make('frontend/contact-us');
	}

	/**
	 * Contact us form processing page.
	 *
	 * @return Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'        => 'required',
			'email'       => 'required|email',
			'description' => 'required',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			return Redirect::route('home')->withErrors($validator);
		}

		$fromEmail = Input::get('email');
	    $fromName = Input::get('name');
	    $subject = 'Chalice Contact-Us submission';
	    $data = array('content' => Input::get('description'));
	
	    $toEmail = 'matt@bigroomstudios.com';
	    $toName = 'Matt Boutet';
		
	    Mail::send('emails.contact', $data, function($message) use ($toEmail, $toName, $fromEmail, $fromName, $subject)
	    {
	        $message->to($toEmail, $toName);
	
	        $message->from($fromEmail, $fromName);	
	
	        $message->subject($subject);
	    });
		return Redirect::route('home')->with('success', "Thanks for your input.");
		
	}

}
