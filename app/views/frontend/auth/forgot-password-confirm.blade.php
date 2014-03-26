@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Enter your new password ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header">
	<h2 class="main-title text-center">Enter your new password</h2>
</header>

<div class="main-content squish">
	<form method="post" action="" class="form-profile form-reset">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<!-- New Password -->
		<p class="{{ $errors->first('password', 'error') }}">
			<label for="password">New Password</label>
			<input type="password" name="password" id="password" value="{{ Input::old('password') }}">
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Password Confirm -->
		<p class="{{ $errors->first('password_confirm', 'error') }}">
			<label for="password_confirm">Confirm Password</label>
			<input type="password" name="password_confirm" id="password_confirm" value="{{ Input::old('password_confirm') }}">
				{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
		</p>

		<button type="submit" class="button button-primary">Reset password</button>
	</form>
</div>

@stop
