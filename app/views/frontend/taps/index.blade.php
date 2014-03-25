@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

<header class="site-teaser">
	<div class="wrapper">
		<h2 class="fit-text">Track & complete your <a href="http://novareresbiercafe.com/" target="_blank">Novare Res</a><br>chalice list from anywhere!</h2>
		<a href="{{ URL::to('about-us') }}" class="button button-primary">Learn more</a>
	</div>
</header>
{{--@if ($message = Session::get('marked'))
	<pre>You successfully checked {{$message}} off your Chalice list</pre>
@elseif ($message = Session::get('unmarked'))
	<pre>You successfully returned {{$message}} to you to-drink list</pre>
@endif --}}
@if ($taps->count())
	<div class="main-content">
		<nav class="beer-lists" role="navigation">
			<a href="{{ route('home') }}" class="button{{ (Request::is('/') ? ' active' : '') }}">On tap</a>
			<a href="{{ route('list') }}" class="button{{ (Request::is('list') ? ' active' : '') }}">Your list</a>
		</nav>

		<ul class="beer">
			@foreach ($taps as $tap)
				@if(array_key_exists($tap->beer_id, $matches))
					@if($matches[$tap->beer_id])
						<li class="beer-item drunk">
					@else
						<li class="beer-item">
					@endif
				@else
					<li class="beer-item">
				@endif
					<h3 class="beer-title"><a href="{{{ $tap->tap_link }}}" title="{{{ $tap->tap_name }}}" target="_blank">{{{ $tap->tap_name }}}</a></h3>

					<div class="beer-action">
						@if(array_key_exists($tap->beer_id, $matches))
							@if($matches[$tap->beer_id])
								{{link_to_action('Controllers\Account\ProfileController@unDrinkBeer', '', array($tap->beer_id), array('class' => 'beer-icon', 'title' => 'Undrink this!')) }}
							@else
								{{link_to_action('Controllers\Account\ProfileController@drinkBeer', '', array($tap->beer_id), array('class' => 'beer-icon', 'title' => 'Drink this!'))}}
							@endif
						@else
						@endif
					</div>
				</li>
			@endforeach
		</ul>
	</div>
@else
	There is currently nothing on tap?
@endif
@stop

{{-- Page content 
@section('content')

<!-- Teaser -->
<header class="site-teaser">
	<div class="wrapper">
		<h2 class="fit-text">Track & complete your <a href="http://novareresbiercafe.com/">Novare Res</a><br>chalice list from anywhere!</h2>
		<a href="{{ URL::to('about-us') }}" class="button button-primary">Learn more</a>
	</div>
</header>

@if ($taps->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Beer Name</th>
				<th>Drank?</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($taps as $tap)
				<tr>
					<td><a href="{{{ $tap->tap_link }}}">{{{ $tap->tap_name }}}</a></td>
					@if(array_key_exists($tap->beer_id, $matches))
						@if($matches[$tap->beer_id])
	                    	<td>{{link_to_action('Controllers\Account\ProfileController@unDrinkBeer', 'UnDrink', array($tap->beer_id), array('class' => 'btn btn-info')) }}</td>
    					@else
	                    	<td>{{link_to_action('Controllers\Account\ProfileController@drinkBeer', 'Drink', array($tap->beer_id), array('class' => 'btn btn-info'))}}</td>
						@endif
    				@else
    					<td></td>
    				@endif                
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There is currently nothing on tap?
@endif

@stop--}}
