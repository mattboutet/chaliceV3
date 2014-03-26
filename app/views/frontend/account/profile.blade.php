@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Your Profile ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')

<header class="main-header">
	<h2 class="main-title text-center">Your profile</h2>
</header>

<section class="main-content profile">
	<form method="post" action="" class="form-profile" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<fieldset class="fieldset-border">
			<legend>Update your profile</legend>

			<div class="grid grid-gutter-half">
				<p class="grid-item one-half{{ $errors->first('first_name', ' error') }}">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name', $user->first_name) }}">
					{{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
				</p>
				<p class="grid-item one-half{{ $errors->first('last_name', ' error') }}">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name', $user->last_name) }}">
					{{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
				</p>
			</div>

			<p class="{{ $errors->first('website', 'error') }}">
				<label for="website">Website URL</label>
				<input type="url" name="website" id="website" value="{{ Input::old('website', $user->website) }}">
				{{ $errors->first('website', '<span class="help-block">:message</span>') }}
			</p>

			<p class="{{ $errors->first('website', 'error') }}">
				<label for="country">Country</label>
				<input type="text" name="country" id="country" value="{{ Input::old('country', $user->country) }}">
				{{ $errors->first('country', '<span class="help-block">:message</span>') }}
			</p>

			<button type="submit" class="button button-primary">Update profile</button>
		</fieldset>
		
		<div class="grid">
			<div class="grid-item medium-one-half">
				<fieldset class="fieldset-border">
					<legend>Change email</legend>

					<p class="{{ $errors->first('email', 'error') }}">
						<label for="email">New Email</label>
						<input type="email" name="email" id="email" value="">
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</p>

					<p class="{{ $errors->first('email_confirm', 'error') }}">
						<label for="email_confirm">Confirm New Email</label>
						<input type="email" name="email_confirm" id="email_confirm" value="">
						{{ $errors->first('email_confirm', '<span class="help-block">:message</span>') }}
					</p>

					<p class="{{ $errors->first('current_password', 'error') }}">
						<label for="current_password">Current Password (<a href="{{ route('forgot-password') }}"></a>)</label>
						<input type="password" name="current_password" id="current_password" value="">
						{{ $errors->first('current_password', '<span class="help-block">:message</span>') }}
					</p>

					<button type="submit" class="button button-secondary">Change email</button>
				</fieldset>
			</div>

			<div class="grid-item medium-one-half">
				<fieldset class="fieldset-border">
					<legend>Change password</legend>

					<p class="{{ $errors->first('old_password', 'error') }}">
						<label for="old_password">Old Password (<a href="{{ route('forgot-password') }}">Forgot?</a>)</label>
						<input type="password" name="old_password" id="old_password" value="">
						{{ $errors->first('old_password', '<span class="help-block">:message</span>') }}
					</p>

					<p class="{{ $errors->first('password', 'error') }}">
						<label class="control-label" for="password">New Password</label>
						<input type="password" name="password" id="password" value="">
						{{ $errors->first('password', '<span class="help-block">:message</span>') }}
					</p>

					<p class="{{ $errors->first('password_confirm', 'error') }}">
						<label class="control-label" for="password_confirm">Confirm New Password</label>
						<input type="password" name="password_confirm" id="password_confirm" value="">
						{{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
					</p>

					<button type="submit" class="button button-secondary">Change password</button>
				</fieldset>
			</div>
		</div>
	</form>
</section>

@stop
