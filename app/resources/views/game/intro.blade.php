@extends('layout.default')

@section('assets')
	@parent
	<script>hj('tagRecording', ['Viewed Game Intro']);</script>
	<link href="/assets/game/css/main.css" rel="stylesheet" type="text/css">
@endsection

@section('grid')

	<div class="pb-header">
	<h1>{{$budget->name}}</h1>
		{{--<p class="lead">{!!$budget->description!!}</p>--}}
	</div>

	<h2 class="pb-cat-header l" style="background:#0b8e4e;">Provided by: {{app('Account')->name}}</h2>
	<div class="container text">

		@if(!empty($budget->video_id))<div class="embed-responsive embed-responsive-16by9"><iframe src="https://www.youtube-nocookie.com/embed/{{$budget->video_id}}?rel=0&amp;showinfo=0" allowfullscreen=""></iframe></div>@endif

		{!!$budget->description!!}

		<div class="cta-wrap-dark text-center">
			<a class="btn btn-success btn-lg" href="{{ route('game.play', [$budget]) }}"><b class="hidden-xs">Ready to go? &nbsp;</b>Start Your Budget!</a>
		</div>

		@include('partials.social-share', [
			'text' => '<b>Excited?</b> Help Spread the Word: &nbsp;&nbsp;',
			'iconSize' => 'md'
		])
	</div>

	<div style="margin-bottom:-60px;"><!-- Revert body padding--></div>
@endsection

@section('deferred')
	@parent
@endsection