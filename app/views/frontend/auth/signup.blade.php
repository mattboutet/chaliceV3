@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Join ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header text-center">
	<h1 class="main-title">Join</h1>
	<p>Chalice is 100% free to use.</p>
</header>

<div class="main-content squish">
	<form method="post" action="{{ route('signup') }}" class="form-profile form-join" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="grid grid-gutter-half">
			<div class="grid-item one-half">
				<!-- First Name -->
				<p class="{{ $errors->first('first_name', 'error') }}">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}">
					{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
				</p>
			</div>
			<div class="grid-item one-half">
				<!-- Last Name -->
				<p class="{{ $errors->first('last_name', 'error') }}">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}">
					{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
				</p>
			</div>
		</div>
		<label class="control-group">List Version</label>
		<div class="grid grid-gutter-half">

			<div class="grid-item one-half">
				<label for="list_version" onclick="">
					<input type="radio" value="1" id="bare" name="bare" checked="checked">
					2012
				</label>
			</div>
			
			<div class="grid-item one-half">
				<label for="list_version" onclick="">
					<input type="radio" value="2" id="bare" name="bare">
					2010
				</label>
			</div>
		</div>
			<p></p>{{--Chris, This probably makes you cringe, but I needed a bit more vertical space and I'm a hack...--}}

		<!-- Email -->
		<p class="{{ $errors->first('email', 'error') }}">
			<label for="email">Email*</label>
			<input type="email" name="email" id="email" value="{{ Input::old('email') }}" required>
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Email Confirm -->
		<p class="{{ $errors->first('email_confirm', 'error') }}">
			<label for="email_confirm">Confirm Email*</label>
			<input type="email" name="email_confirm" id="email_confirm" value="{{ Input::old('email_confirm') }}" required>
			{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Password -->
		<p class="{{ $errors->first('password', 'error') }}">
			<label for="password">Password*</label>
			<input type="password" name="password" id="password" value="" required>
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Password Confirm -->
		<p class="{{ $errors->first('password_confirm', 'error') }}">
			<label for="password_confirm">Confirm Password*</label>
			<input type="password" name="password_confirm" id="password_confirm" value="" required>
			{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Form actions -->
		<button type="submit" class="button button-primary">Create account</button>
		<span class="form-required">* required field</span>
	</form>
</div>
@stop
