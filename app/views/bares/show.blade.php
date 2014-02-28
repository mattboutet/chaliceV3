@extends('layouts.scaffold')

@section('main')

<h1>Show Bare</h1>

<p>{{ link_to_route('bares.index', 'Return to all bares') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Beer_ids</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $bare->beer_ids }}}</td>
                    <td>{{ link_to_route('bares.edit', 'Edit', array($bare->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('bares.destroy', $bare->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
