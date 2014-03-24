@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Login ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header">
	<h2 class="main-title text-center">Login</h2>
</header>

<div class="main-content squish">
	<form method="post" action="{{ route('signin') }}" class="form-profile form-login">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<!-- Email -->
		<p class="{{ $errors->first('email', 'error') }}">
			<label for="email">Email</label>
			<input type="text" name="email" id="email" value="{{ Input::old('email') }}" required>
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Password -->
		<p class="{{ $errors->first('password', 'error') }}">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="" required>
			{{ $errors->first('password', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Remember me -->
		<p>
			<label class="checkbox">
				<input type="checkbox" name="remember-me" id="remember-me" checked> Remember me
			</label>
		</p>

		<!-- Form actions -->
		<p><button type="submit" class="button button-primary">Login</button></p>
		<div class="form-forgot">
			<a href="{{ route('forgot-password') }}">Forgot your password?</a>
		</div>
	</form>
</div>
@stop
