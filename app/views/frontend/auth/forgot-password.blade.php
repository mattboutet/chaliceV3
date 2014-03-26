@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
Forgot your password? ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header">
	<h2 class="main-title text-center">Forgot your password?</h2>
</header>

<div class="main-content squish">
	<form method="post" action="" class="form-profile form-forgot">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<!-- Email -->
		<p class="{{ $errors->first('email', 'error') }}">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="{{ Input::old('email') }}" required>
			{{ $errors->first('email', '<span class="help-block">:message</span>') }}
		</p>

		<!-- Form actions -->
		<button type="submit" class="button button-primary">Reset password</button>
	</form>
</div>
@stop
