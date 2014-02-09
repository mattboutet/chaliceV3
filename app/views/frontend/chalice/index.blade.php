@extends('frontend/layouts/default')

{{-- Page content --}}
@section('content')

@if ($beers->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Beer_name</th>
				<th>Beer_style</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($beers as $beer)
				
				<tr>
					<td>{{{ $beer->beer_name }}}</td>
					<td>{{{ $beer->beer_style }}}</td>
					<td>{{{ $beer->pivot->checked }}}</td>
					
                    <td>{{ link_to_route('beers.edit', 'Edit', array($beer->id), array('class' => 'btn btn-info')) }}</td>
                    
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no beers
@endif

@stop
