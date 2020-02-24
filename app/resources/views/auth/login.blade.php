@extends('layout.page')

@section('content')
	<div class="row">
	    <div class="col-xs-12">
			@include('auth.login-box', ['visible'=>true])
		</div>
	</div>
@endsection

@section('assets')
	@parent
	<link href="/assets/game/css/auth.css" rel="stylesheet" type="text/css">
@endsection