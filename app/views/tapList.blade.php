@extends('layout')

@section('content')

    @foreach($list as $list_item)
		<p>{{$list_item}}</p>
	@endforeach
@stop