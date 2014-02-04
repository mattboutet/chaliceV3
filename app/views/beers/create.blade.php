@extends('layouts.scaffold')

@section('main')

<h1>Create Beer</h1>

{{ Form::open(array('route' => 'beers.store')) }}
	<ul>
        <li>
            {{ Form::label('beer_name', 'Beer_name:') }}
            {{ Form::text('beer_name') }}
        </li>

        <li>
            {{ Form::label('beer_style', 'Beer_style:') }}
            {{ Form::text('beer_style') }}
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


