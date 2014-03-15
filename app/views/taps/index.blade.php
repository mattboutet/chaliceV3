@extends('layouts.scaffold')

@section('main')

<h1>Chalice!</h1>

@if ($taps->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Beer Name</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($taps as $tap)
				<tr>
					<td><a href="{{{ $tap->tap_link }}}">{{{ $tap->tap_name }}}</a></td>
					@if(array_key_exists($tap->beer_id, $matches))
						@if($matches[$tap->beer_id])
	                    	<td>{{link_to_action('Controllers\Admin\UsersController@unDrinkBeer', 'UnDrink', array($tap->beer_id), array('class' => 'btn btn-info')) }}</td>
    					@else
	                    	<td>{{link_to_action('Controllers\Admin\UsersController@drinkBeer', 'Drink', array($tap->beer_id), array('class' => 'btn btn-info'))}}</td>
						@endif
    				@endif                
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There is currently nothing on tap?
@endif

@stop
