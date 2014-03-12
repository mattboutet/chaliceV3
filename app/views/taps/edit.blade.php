@extends('layouts.scaffold')

@section('main')

<h1>Edit Tap</h1>
{{ Form::model($tap, array('method' => 'PATCH', 'route' => array('taps.update', $tap->id))) }}
	<ul>
        <li>
            {{ Form::label('tap_name', 'Tap_name:') }}
            {{ Form::text('tap_name') }}
        </li>

        <li>
            {{ Form::label('tap_link', 'Tap_link:') }}
            {{ Form::text('tap_link') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('taps.show', 'Cancel', $tap->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
