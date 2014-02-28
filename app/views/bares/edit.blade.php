@extends('layouts.scaffold')

@section('main')

<h1>Edit Bare</h1>
{{ Form::model($bare, array('method' => 'PATCH', 'route' => array('bares.update', $bare->id))) }}
	<ul>
        <li>
            {{ Form::label('beer_ids', 'Beer_ids:') }}
            {{ Form::text('beer_ids') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('bares.show', 'Cancel', $bare->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
