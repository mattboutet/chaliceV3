@extends('layouts.scaffold')

@section('main')

<h1>All Bares</h1>

<p>{{ link_to_route('bares.create', 'Add new bare') }}</p>

@if ($bares->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Beer_ids</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($bares as $bare)
				<tr>
					<td>{{{ $bare->beer_ids }}}</td>
                    <td>{{ link_to_route('bares.edit', 'Edit', array($bare->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('bares.destroy', $bare->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no bares
@endif

@stop
