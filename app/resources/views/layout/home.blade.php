@extends('layout.default')

@section('title', app('Account')->city.", ".app('Account')->state)

@section('assets')
	@parent
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	{{--<link rel="stylesheet" href="/assets/home/css/bootstrap.css">--}}
	<link rel="stylesheet" href="/assets/home/css/main.css">
@endsection

@section('grid')

  <div id="wrapper">
    <header class="header">
      <div class="container">
        <a href="https://peoplesbudget.com" target="_blank">
          <h1 class="logo text-hide">PeoplesBudget</h1>
        </a>
        <span class="head-text">A budget planning tool for the citizens of {{app('Account')->city}}. <a href="https://peoplesbudget.com" target="_blank">Learn More</a></span>
      </div>
    </header>
    <main class="main">
      <div class="banner-block" style="background-image:url({{app('Account')->bannerImg()}})">

        @if(array_key_exists('thanks', $_GET))
        <div style="padding-top:120px; font-size:18px;">
          <div class="container">
            <div class="alert alert-success"><b>You're done!</b><br> Thank you for participating. Your feedback is vitally important!</div>
          </div>
        </div>
        @endif

        <img src="{{app('Account')->bannerImg()}}" alt="image description" class="hidden">
      </div>
      <div class="navbar-hold">
        <div class="container">
          <span class="bar-text">It's your city. It's your money. You decide.</span>
          <div class="logo-hold">
            <a href="/">
              <img src="{{app('Account')->logoImg()}}" alt="{{app('Account')->name}}">
            </a>
          </div>
          <div class="wrap">
            <nav id="nav">
              <ul>
                <li><a href="/">HOME</a></li>
                @foreach ($pages as $page)
                  <li><a href="/{{$page->slug}}">{{$page->title}}</a></li>
                @endforeach
                @if(Auth::check() && Auth::user()->isAdmin())<li><a href="/admin" class="navbar-admin-link"><b>Admin</b></a></li>@endif
              </ul>
            </nav>
          </div>
          <div class="dropdown">
            @if(count($budgets))
              <a class="btn btn-primary js-play-budget" href="/budget/{{$budgets->first()->id}}">Play Now <span class="fa fa-chevron-circle-right"></span></a>
            @else
              <a class="btn btn-primary">Coming Soon!</a>
            @endif
          </div>
        </div>
      </div>
      <div class="main-content">

	  @if(count($errors))
		<div style="background:#fff">
			<br>
			<div class="container">
				@include('partials.errors')
			</div>
		</div>
		@endif
		@yield('content')

      </div>
    </main>
    <footer class="footer">
      <div class="container">
        <div class="social-hold">
          <span class="txt">Excited? Help Spread the Word:</span>
          <div class="social-share-icons social-share-icons-md"></div>
        </div>
        <span class="copyright">© People's Budget 2017</span>
      </div>
    </footer>
  </div>

@endsection

@section('deferred')
	@parent

@endsection