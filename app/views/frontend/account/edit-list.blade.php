@extends('frontend/layouts/account')

{{-- Page title --}}
@section('title')
Your Profile
@stop

{{-- Account page content --}}
@section('account-content')
<div class="page-header">
	<h4>Update your List</h4>
</div>

<form method="post" action="" class="form-vertical" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	@if ($chaliceList->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Your Chalice List</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($chaliceList as $beer)
				<tr>
					<td>{{{ $beer->beer_name }}}</td>
					<td>{{Form::checkbox("checked[]", $beer->id, $beer->pivot->checked)}}</td>
					{{--<td><input type="checkbox" name="checked.{{{$beer->id}}}" id="{{{$beer->id}}}" value="{{{$beer->id}}}" @if($beer->pivot->checked) checked @endif>--}}{{--Need a checkbox prepop with drank value here?--}}</td>                
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There is currently nothing on tap?
@endif
	<hr>

	<!-- Form actions -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update your List</button>
		</div>
	</div>
</form>
@stop
