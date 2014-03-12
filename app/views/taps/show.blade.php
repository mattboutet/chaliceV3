@extends('layouts.scaffold')

@section('main')

<h1>Show Tap</h1>

<p>{{ link_to_route('taps.index', 'Return to all taps') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Tap_name</th>
				<th>Tap_link</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $tap->tap_name }}}</td>
					<td>{{{ $tap->tap_link }}}</td>
                    <td>{{ link_to_route('taps.edit', 'Edit', array($tap->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('taps.destroy', $tap->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
