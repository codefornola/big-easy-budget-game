@extends('layout.home')

@if(!empty($page) && 'index' != $page->slug)
  @section('title', "{$page->title} | " .app('Account')->city.", ".app('Account')->state)
@endif

@section('content')

	<div class="container">
      <div class="row">
        <div class="col-sm-8 col-lg-9">
          {!! $page->content !!}
        </div>
        <div class="col-sm-4 col-lg-3">
          <div class="box">
            <div class="outer">
              <div class="inner">
                <div class="icon-hold">
                  <img src="/assets/home/img/ico01.png" alt="image description">
                </div>
                <span class="text">Real Budget Spending</span>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="outer">
              <div class="inner">
                <div class="icon-hold">
                  <img src="/assets/home/img/ico02.png" alt="image description">
                </div>
                <span class="text">Have Your Voice Heard</span>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="outer">
              <div class="inner">
                <div class="icon-hold">
                  <img src="/assets/home/img/ico03.png" alt="image description">
                </div>
                <span class="text">Create A Better Budget</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  @include('home.partials.budget-list-modal')

@endsection

@section('deferred')
	@parent
	@if(Request::has('showLogin'))<script>showLoginDialog();</script>@endif
@endsection