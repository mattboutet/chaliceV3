@extends('layouts.scaffold')

@section('main')

<h1>All Beers</h1>

<p>{{ link_to_route('beers.create', 'Add new beer') }}</p>

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
                    <td>{{ link_to_route('beers.edit', 'Edit', array($beer->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('beers.destroy', $beer->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no beers
@endif

@stop
