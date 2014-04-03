@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
About Chalice ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header text-center">
	<h2 class="main-title">What is Chalice?</h2>
</header>

<div class="main-content squish">
	<p>Chalice is a free web app, which you can use to track and update your beer list at one of our favorite bars, <a href="http://novareresbiercafe.com/">Novare Res</a> in Portland, Maine.</p>

	<p>Many patrons like us, here at <a href="http://bigroomstudios.com">BRS</a>, participate in “The Uprising” challenge to drink every beer on their list. It’s a long list. If you try all the beers on their list, you're awarded a kick-ass chalice.</p>

	<p>Currently, you can only track your progress with pen and paper, which is risky. If you lose your list you have to start over, and it's always a challenge trying to figure out what's on your list and also currently on tap. We made Chalice, so that we can track our progress from our phones, via this simple web app.</p>

	<p>Note: This app is not affiliated with Novare Res.  It's meant to help you keep track of the beers on your list, but doesn't in any way replace your paper list</p>
	<h3 class="h2">How it works</h3>

	<ol>
		<li>Buy a beer</li>
		<li>Visit <a href="http://www.chaliceapp.com">http://www.chaliceapp.com</a> on your smart phone</li>
		<li>Check off the beer</li>
		<li>Drink the beer</li>
		<li>See step 1</li>
	</ol>

	<p><span class="run-in">Protip:</span> You can add a Chalice App icon to the home screen on your mobile device for quicker access to this web app.</p>

	<p><a href="http://www.pcadvisor.co.uk/how-to/google-android/3447950/add-bookmarks-home-screen-in-android/">Android tutorial</a> &bull; <a href="http://www.tech-recipes.com/rx/44908/ios-add-website-shortcut-to-home-screen/">iOS tutorial</a></p>

	<h3 class="h2">Questions?</h3>

	<p>If you have any questions, please feel free to contact us using the handy form below. Happy drinking!</p>

	<form method="post" action="" class="form-contact">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />

		<fieldset>
			<!-- Name -->
			<p class="{{ $errors->first('name', 'error') }}">
				<input type="text" id="name" name="name" class="input-block-level" placeholder="Your name">
				{{ $errors->first('name', '<span class="help-block">:message</span>') }}
			</p>

			<!-- Email -->
			<p class="{{ $errors->first('email', 'error') }}">
				<input type="text" id="email" name="email" class="input-block-level" placeholder="Your email">
				{{ $errors->first('email', '<span class="help-block">:message</span>') }}
			</p>

			<!-- Description -->
			<p class="{{ $errors->first('description', 'error') }}">
				<textarea rows="8" id="description" name="description" class="input-block-level"
	placeholder="What’s on your mind?"></textarea>
				{{ $errors->first('description', '<span class="help-block">:message</span>') }}
			</p>

			<!-- Form actions -->
			<button type="submit" class="button button-primary">Send message</button>
		</fieldset>
	</form>
</div>

@stop
