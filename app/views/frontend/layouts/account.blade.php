@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="main-content">
	@yield('account-content')
</div>

@stop
