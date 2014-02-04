@extends('layouts.scaffold')

@section('main')

<h1>Edit Beer</h1>
{{ Form::model($beer, array('method' => 'PATCH', 'route' => array('beers.update', $beer->id))) }}
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
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('beers.show', 'Cancel', $beer->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
