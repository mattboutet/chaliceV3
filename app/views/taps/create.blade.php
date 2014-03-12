@extends('layouts.scaffold')

@section('main')

<h1>Create Tap</h1>

{{ Form::open(array('route' => 'taps.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


