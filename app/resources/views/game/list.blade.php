@extends('layout.home')

@section('assets')
	@parent
	<script>hj('tagRecording', ['Viewed Game List']);</script>
	{{--<link rel="stylesheet" href="/assets/vendor/flavr/css/animate.css">--}}
	{{--<link href="/assets/css/index.css" rel="stylesheet" type="text/css">--}}
	{{--<link href='https://fonts.googleapis.com/css?family=Alice' rel='stylesheet' type='text/css'>--}}
@endsection

@section('content')

	@include('home-old.partials.header')

	<div class="site-content text-center">

		<div class="container">
			<div class="site-content-main text-center">

				<h2 class="text-center">Language Options</h2>
				<p>Our 2016 budget game is available in two languages. Continue by selecting your language of choice below.</p>
				<div class="row">
					<div class="col-md-6">
						<div class="cta-wrap-dark text-center">
							<a class="btn btn-success btn-lg" href="{{ route('game.intro', [$budgetEn]) }}"><span class="hidden-xs">Play the Game in </span><b>English</b></a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="cta-wrap-dark text-center">
							<a class="btn btn-success btn-lg" href="{{ route('game.intro', [$budgetEs]) }}"><span class="hidden-xs">Participe en el Juego en</span><b>Español</b></a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
@endsection

@section('deferred')
	@parent
	{{--	@if(Request::has('showLogin'))<script>showLoginDialog();</script>@endif--}}
@endsection