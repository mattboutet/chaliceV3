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

	<form method="post" action="" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		@if ($chaliceList->count())
			<ul class="beer">
				@foreach ($chaliceList as $beer)
					@if ($beer->pivot->checked)
					<li class="beer-item drunk" id="{{{$beer->id}}}">
					@else
					<li class="beer-item" id="{{{$beer->id}}}">
					@endif
						<h3 class="beer-title"><a href="http://www.google.com/search?q=site:beeradvocate.com+{{{$beer->beer_name}}}" title="{{{ $beer->beer_name }}}" target="_blank">{{{ $beer->beer_name }}}</h3>
						<div class="beer-action" id="{{{$beer->id}}}">
							@if ($beer->pivot->checked)
								{{link_to_action('Controllers\Account\ProfileController@unDrinkBeer', '', array($beer->id), array('class' => 'beer-icon', 'title' => 'Undrink this!', 'beer_id' => $beer->id)) }}
							@else
								{{link_to_action('Controllers\Account\ProfileController@drinkBeer', '', array($beer->id), array('class' => 'beer-icon', 'title' => 'Drink this!'))}}
							@endif
							{{--<div class="beer-icon"></div>
							{{Form::checkbox("checked[]", $beer->id, $beer->pivot->checked)}}--}}
						</div>
					</li>
				@endforeach
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
