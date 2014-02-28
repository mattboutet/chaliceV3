@extends('layouts.scaffold')

@section('main')

<h1>Create Bare</h1>

{{ Form::open(array('route' => 'bares.store')) }}
	<ul>
        <li>
            {{ Form::label('beer_ids', 'Beer_ids:') }}
            {{ Form::text('beer_ids') }}
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


