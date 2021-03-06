@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Your list ::
@parent
@stop

{{-- Account page content --}}
@section('account-content')

<header class="site-teaser">
	<div class="wrapper">
		<h2 class="fit-text">Track & complete your <a href="http://novareresbiercafe.com/" target="_blank">Novare Res</a><br>chalice list from anywhere!</h2>
		<a href="{{ URL::to('about-us') }}" class="button button-primary">Learn more</a>
	</div>
</header>

<div class="main-content">
	<nav class="beer-lists" role="navigation">
		<a href="{{ route('home') }}" class="button{{ (Request::is('/') ? ' active' : '') }}">On tap</a>
		<a href="{{ route('list') }}" class="button{{ (Request::is('account/list') ? ' active' : '') }}">Your list</a>
	</nav>

	<nav class="beer-search" role="navigation">
		<i class="icon-search"></i>
		<input class="search-beers" type="text" placeholder="Find a beer">
	</nav>

	<form method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		@if ($chaliceList->count())
			<ul class="beer">
				@if($style = '' && $not_empty = TRUE)@endif {{--super-duper hacky, but blade doesn't allow variable assignment?--}}

				@foreach ($chaliceList as $beer)
					@if($style != $beer->beer_style && !$beer->pivot->checked)
						<li class="beer-item beer-style">
							<h2 class="beer-name h3">{{$beer->beer_style}}</h2>
							@if($style = $beer->beer_style) @endif
						</li>
					@endif

					@if ($beer->pivot->checked)
						<li id="{{{$beer->id}}}" class="beer-item drunk {{$beer->beer_style}}">
					@else
						<li id="{{{$beer->id}}}" class="beer-item {{$beer->beer_style}}">
					@endif
						<div class="beer-actions">
							<div class="beer-toggle">
								<h3 class="beer-name">{{{ $beer->beer_name }}}</h3>
							</div>

							<div class="beer-cb" id="{{{$beer->id}}}">
								<span class="label label-success" style="display: none">Saved!</span>
								@if ($beer->pivot->checked)
									{{link_to_action('Controllers\Account\ProfileController@unDrinkBeer', '', array($beer->id), array('class' => 'beer-icon', 'title' => 'Undrink this!', 'beer_id' => $beer->id)) }}
								@else
									{{link_to_action('Controllers\Account\ProfileController@drinkBeer', '', array($beer->id), array('class' => 'beer-icon', 'title' => 'Drink this!'))}}
								@endif
							</div>
						</div>
						
						<div class="beer-info">
							{{ $beer->description }}
						</div>
						
					</li>
				@endforeach

				<li class="beer-item beer-none">
					<h3>We couldn't find any beers!</h3>
				</li>
				
			</ul>

			{{--<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Your Chalice List</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($chaliceList as $beer)
						<tr>
							<td>{{{ $beer->beer_name }}}</td>
							<td>{{Form::checkbox("checked[]", $beer->id, $beer->pivot->checked)}}</td>
							{{--<td><input type="checkbox" name="checked.{{{$beer->id}}}" id="{{{$beer->id}}}" value="{{{$beer->id}}}" @if($beer->pivot->checked) checked @endif>--}}{{--Need a checkbox prepop with drank value here?</td>
						</tr>
					@endforeach
				</tbody>
			</table>--}}
		@else
			There is currently nothing on tap?
		@endif
		<br>
	</form>
	@stop
</div>
