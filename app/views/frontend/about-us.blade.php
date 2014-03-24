@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
About Chalice ::
@parent
@stop

{{-- Page content --}}
@section('content')

<header class="main-header text-center">
	<!-- <figure class="header-image"><img src="{{ asset('assets/img/logo-white.svg') }}" alt="Chalice"></figure> -->
	<h2 class="main-title">What is Chalice?</h2>
</header>

<div class="main-content squish">
	<p>Chalice is a free web app, which you can use to track and update your beer list at one of our favorite bars, <a href="http://novareresbiercafe.com/">Novare Res</a> in Portland, Maine.</p>

	<p>Many patrons like us, here at <a href="http://bigroomstudios.com">BRS</a>, participate in “The Uprising” challenge to drink every beer on their list. It’s a long list. If you try all the beers on their list, you win a kick-ass chalice.</p>

	<p>Currently, you can only track your progress with pen and paper, which is risky. If you lose your list you have to start over! We made Chalice, so that we can track our progress from our phones, via this simple web app.</p>

	<h3 class="h2">How it works</h3>

	<ol>
		<li>Buy a beer</li>
		<li>Pull out your phone</li>
		<li>Check off the beer</li>
		<li>Drink the beer</li>
		<li>See step 1</li>
	</ol>

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
