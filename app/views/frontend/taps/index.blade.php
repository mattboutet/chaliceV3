@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

<header class="site-teaser">
	<div class="wrapper">
		<h2 class="fit-text">Track & complete your <a href="http://novareresbiercafe.com/" target="_blank">Novare Res</a><br>chalice list from anywhere!</h2>
		<a href="{{ URL::to('about-us') }}" class="button button-primary">Learn more</a>
	</div>
</header>

@if ($taps->count())
<div class="main-content">
	<nav class="beer-lists" role="navigation">
		<a href="{{ route('home') }}" class="button{{ (Request::is('/') ? ' active' : '') }}">On tap</a>
		<a href="{{ route('list') }}" class="button{{ (Request::is('list') ? ' active' : '') }}">Your list</a>
	</nav>

	<nav class="beer-search" role="navigation">
		<i class="icon-search"></i>
		<input class="search-beers" type="text" placeholder="Find a beer">
	</nav>
	
	<ul class="beer">
		@foreach ($taps as $tap)
			@if(array_key_exists($tap->beer_id, $matches))
				@if($matches[$tap->beer_id])
					<li id="beer-{{{ $tap->beer_id }}}" class="beer-item drunk" >
				@else
					<li id="beer-{{{ $tap->beer_id }}}" class="beer-item">
				@endif
			@else
				<li id="beer-{{{ $tap->beer_id }}}" class="beer-item">
			@endif

			<div class="beer-actions">

				<div class="beer-toggle">
					<h3 class="beer-name">{{{ $tap->tap_name }}}</h3>
				</div>

				@if (Sentry::check())
					@if(array_key_exists($tap->beer_id, $matches))
						<div class="beer-cb">
							<span class="label label-success" style="display: none">Saved!</span>
							<span class="label label-info">On list</span>
							@if($matches[$tap->beer_id])
								{{link_to_action('Controllers\Account\ProfileController@unDrinkBeer', '', array($tap->beer_id), array('class' => 'beer-icon', 'title' => 'Undrink this!', 'beer_id' => $tap->beer_id)) }}
							@else
								{{link_to_action('Controllers\Account\ProfileController@drinkBeer', '', array($tap->beer_id), array('class' => 'beer-icon', 'title' => 'Drink this!'))}}
							@endif
						</div>
					@else
					@endif
				@else
				@endif

			</div>

			<div class="beer-info">
				{{ $tap->description }}
			</div>
		</li>
		@endforeach
		
		<li class="beer-item beer-none">
			<h3>We couldn’t find any beers!</h3>
		</li>
		
	</ul>
</div>
@else
	There is currently nothing on tap?
@endif
@stop
