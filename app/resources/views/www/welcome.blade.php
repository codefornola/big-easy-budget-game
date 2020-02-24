<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Crowd-sourced budget planning, powered by a game-like community tool.">
    <meta name="keywords" content="participatory budgets, budget planning, city budgets, budget game">

    <link rel="apple-touch-icon" sizes="57x57" href="/assets/www/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/www/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/www/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/www/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/www/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/www/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/www/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/www/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/www/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/www/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/www/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/www/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/www/icons/favicon-16x16.png">
    <link rel="manifest" href="/assets/www/icons/manifest.json">

    <title>The People's Budget | Crowd-sourced budget planning</title>

    <link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet">
    <link href="/assets/www/css/toolkit-minimal.min.css" rel="stylesheet">
    <link href="/assets/www/css/app.css" rel="stylesheet">

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
              m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-77922332-1', 'auto');
      ga('send', 'pageview');

    </script>

    <script src="https://use.typekit.net/cdf4rqk.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

  </head>

  <body>

    <nav class="navbar navbar-default navbar-static-top navbar-padded text-uppercase app-navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img src="/assets/www/img/logo.png" style="max-width:150px;" class="img-responsive" alt="The People's Budget">
          </a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#features">Features</a>
            </li>
            <li>
              <a href="#press">Press</a>
            </li>
            <li>
              <a href="#pricing">Pricing</a>
            </li>
            <li>
              <a href="#" data-toggle="modal" data-target=".app-modal-signup">Contact</a>
            </li>
            {{--<li>--}}
              {{--<a href="#" data-toggle="modal" data-target=".app-modal-login">Login</a>--}}
            {{--</li>--}}
            <li>
              <a href="#" class="feature" data-toggle="modal" data-target=".app-modal-signup">Get Started <span class="icon icon-chevron-right hidden-xs"></span></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="block app-block-intro">
      <div class="container-fluid">
        {{--<div class="row hidden-xs">--}}
          {{--<div class="col-sm-offset-3 col-sm-6 text-center">--}}
            {{--<h1 class="app-brand-logo hide-text">The People's Budget</h1>--}}
            {{--<p class="lead m-b-lg p-b-md">Crowd-sourced budget planning.</p>--}}
          {{--</div>--}}
        {{--</div>--}}
        <div class="row">
          <div class="col-sm-4">
            <div class="block block-transparent app-block-intro-callout text-center">
              <h2 class="block-title">Crowd-sourced budget planning</h2>
              <h4 class="text-muted">A simple & affordable community tool.</h4>
              <button class="btn btn-primary btn-pill m-t" data-toggle="modal" data-target=".app-modal-video" data-video-id="06HNzs6J3_g"><span class="icon icon-controller-play"></span> WATCH THE VIDEO</button>
              {{--<button class="btn btn-primary-outline btn-pill m-t">SIGN UP <span class="icon icon-chevron-right"></span></button>--}}
              <div class="app-block-intro-start text-muted" style="padding-top:10%;">
                Or <a href="#" data-toggle="modal" data-target=".app-modal-signup">Sign Up</a> for Early Access
              </div>
            </div>
          </div>
          <div class="col-sm-8">
              <img class="intro-img" src="/assets/www/img/screen-lg-admin.png">
          </div>
        </div>
      </div>
    </div>

    <a name="features"></a>

    <div class="block">
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 text-center m-b-lg">
            <p class="lead m-x-auto">
              <strong>The answers to your city’s most complex challenges might be found in your own community.</strong>
             <span class="text-nowrap">We believe some</span> of the best ideas for any city come from the people who live there, so we created the People’s Budget – a game-like tool that enables any community member to create his or her own version of your city’s budget. It’s easy, it’s fun, and it captures the collective knowledge of your community!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <ul class="featured-list">

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-flow-tree"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Categories & divisions</strong></p>
                <p class="featured-list-icon-text">
                  Get feedback on your entire city budget, or just focus on a single department. It's customizable, flexible and scalable.
                </p>
              </li>

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-facebook"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Social login & sharing</strong></p>
                <p class="featured-list-icon-text">
                  Validate each of your players through Facebook, Google, or email to keep your results clean and reliable.
                </p>
              </li>

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-folder-images"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Downloadable media packet</strong></p>
                <p class="featured-list-icon-text">
                  We'll help you hit the ground running with some customizable outreach and informational materials.
                </p>
              </li>

            </ul>
          </div>
          <div class="col-sm-6">
            <ul class="featured-list">

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-check"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Quick polls</strong></p>
                <p class="featured-list-icon-text">
                  Ask your users customized questions along the way for more specific insight into an area of your budget.
                </p>
              </li>

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-pie-chart"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Detailed, exportable reports</strong></p>
                <p class="featured-list-icon-text">
                  View your results in info-graphics or export the raw data. Once you have your data, put it to work.
              </p>
              </li>

              <li class="m-b-lg">
                <div class="featured-list-icon text-primary">
                  <span class="icon icon-thunder-cloud"></span>
                </div>
                <p class="featured-list-icon-text m-b-0"><strong>Hosted in the cloud</strong></p>
                <p class="featured-list-icon-text">
                  No software to download. No upgrades to install. We handle the tech stuff you don't have time to worry about.
                </p>
              </li>

            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-8 col-sm-offset-2 text-center m-b-lg">
            <p class="lead m-x-auto"><strong>And much more!</strong> Interested in learning more? We're happy to assist.</p>
            <p class="lead m-x-auto"><a href="#" data-toggle="modal" data-target=".app-modal-signup" class="btn btn-lg btn-pill btn-primary text-uppercase">Get in Touch<span class="icon icon-chevron-right"></span></a></p>
          </div>
        </div>

      </div>
    </div>


    <a name="press"></a>

    <div class="block block-bordered-lg">
      <div class="container text-center app-translate-15" data-transition="entrance">
        <h3 class="text-muted m-b-lg">Some amazing organizations are buzzing about the People's Budget:</h3>
        <div class="row">
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/pbp.png" alt="" class="press-logo img-responsive"></div>
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/fast-company.png" alt="" class="press-logo img-responsive"></div>
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/idealista.png" alt="" class="press-logo img-responsive"></div>
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/next-city.png" alt="" class="press-logo img-responsive"></div>
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/nola-com.png" alt="" class="press-logo img-responsive"></div>
          <div class="col-xs-4 col-sm-2"><img src="/assets/www/img/press-logos/gcn.png" alt="" class="press-logo img-responsive"></div>
        </div>
      </div>
    </div>

    <div class="block block-bordered-lg">
      <div class="container text-center app-translate-15" data-transition="entrance">
        <blockquote class="pull-quote m-b-lg">
          <img class="img-circle" src="/assets/www/img/quote-profile-pic-nola.png">
          <p>
            “I think it’s exciting and I think it’s really time. You know what, the people are still in charge, people know what their needs are, and <strong>they’re the world’s greatest experts</strong> on what’s needed.”
          </p>
          <cite>LaToya Cantrell, New Orleans City Council</cite>
        </blockquote>
        <blockquote class="pull-quote">
          <img class="img-circle" src="/assets/www/img/quote-profile-pic-tulane.jpg">
          <p>
            “Making resources like this one available to those with less opportunities or education in politics is essential. These large statewide and city-wide decisions affect everyone, even those without a college degree. By having all stakeholders participating in the political system, <strong>huge issues like this budget crisis don't have to occur.</strong>”
          </p>
          <cite>Kathryne LeBell, The Tulane Hullabaloo</cite>
        </blockquote>
      </div>
    </div>

    <div class="block block-bordered-lg block-overflow-hidden p-b-0 app-block-design">
      <div class="container">
        <div class="row pos-r">
          <div class="col-sm-7 text-xs-center text-sm-left">
            <p class="lead">
              We focused on simplicity and user friendliness. That's why on average, each community member takes only 11 minutes to fund 27 organizations with a budget over $600,000,000.
            </p>
            <div class="row">
              <div class="col-sm-4 m-b-md">
                <div class="statcard">
                  <h1 class="statcard-number block-title">11</h1>
                  <span class="statcard-desc">minutes</span>
                </div>
              </div>
              <div class="col-sm-4 m-b-md">
                <div class="statcard">
                  <h1 class="statcard-number block-title">27</h1>
                  <span class="statcard-desc">organizations</span>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="statcard">
                  <h1 class="statcard-number block-title">600m</h1>
                  <span class="statcard-desc">dollars</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-right app-block-design-img">
        <img src="/assets/www/img/iphone-reverse-perspective-sized.jpg" class="app-translate-50" data-transition="entrance">
      </div>
    </div>

    {{--<div class="block block-bordered-lg p-b-0 app-block-stats">--}}
      {{--<div class="container">--}}
        {{--<div class="row">--}}
          {{--<div class="col-md-7 col-sm-6">--}}
            {{--<img src="/assets/www/img/iphone-perspective-sized.jpg" class="app-translate-5" data-transition="entrance">--}}
            {{--<hr class="m-t-0 m-b-lg m-x-auto visible-xs">--}}
          {{--</div>--}}
          {{--<div class="col-md-5 col-sm-6 text-xs-center text-sm-left">--}}
            {{--<p class="lead">--}}
              {{--We've been working for over 100 years to build the best possible app for all your needs. We're glad that others agree.--}}
            {{--</p>--}}
            {{--<div class="row m-y-md">--}}
              {{--<div class="col-xs-6">--}}
                {{--<div class="statcard">--}}
                  {{--<h1 class="statcard-number block-title">92m</h1>--}}
                  {{--<span class="statcard-desc">Downloads</span>--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="col-xs-6">--}}
                {{--<div class="statcard">--}}
                  {{--<h1 class="statcard-number block-title">8m</h1>--}}
                  {{--<span class="statcard-desc">Reviews</span>--}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row hidden-sm">--}}
              {{--<div class="col-xs-6 m-b-lg">--}}
                {{--<div class="statcard">--}}
                  {{--<h1 class="statcard-number block-title">78k</h1>--}}
                  {{--<span class="statcard-desc">Developers</span>--}}
                {{--</div>--}}
              {{--</div>--}}
              {{--<div class="col-xs-6 m-b-lg">--}}
                {{--<div class="statcard">--}}
                  {{--<h1 class="statcard-number block-title">97%</h1>--}}
                  {{--<span class="statcard-desc">Happiness</span>--}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}


    {{--<div class="block block-bordered-lg p-l-0 p-t-0 p-r-0">--}}
      {{--<div id="carousel-example-generic-2" class="carousel carousel-light slide" data-ride="carousel">--}}
        {{--<ol class="carousel-indicators">--}}
          {{--<li data-target="#carousel-example-generic-2" data-slide-to="0" class="active"></li>--}}
          {{--<li data-target="#carousel-example-generic-2" data-slide-to="1"></li>--}}
          {{--<li data-target="#carousel-example-generic-2" data-slide-to="2"></li>--}}
        {{--</ol>--}}
        {{--<div class="carousel-inner" role="listbox">--}}
          {{--<div class="item active">--}}
            {{--<div class="block">--}}
              {{--<div class="container">--}}
                {{--<div class="row">--}}
                  {{--<div class="col-sm-8 col-sm-offset-2">--}}
                    {{--<p class="lead m-x-auto text-center">--}}
                      {{--Instead of guessing how much time you spend on each of your tasks, why not have automagically record everything and have easy reporting without lifting a finger? <span class="hidden-xs">Well now you can with ease.</span>--}}
                    {{--</p>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<img class="img-responsive m-t-lg app-block-game-img" src="/assets/www/img/iphone-flat-sized.jpg">--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
          {{--<div class="item">--}}
            {{--<div class="block">--}}
              {{--<div class="container">--}}
                {{--<div class="row">--}}
                  {{--<div class="col-sm-8 col-sm-offset-2">--}}
                    {{--<p class="lead m-x-auto text-center">--}}
                      {{--Instead of guessing how much time you spend on each of your tasks, why not have automagically record everything and have easy reporting without lifting a finger? <span class="hidden-xs">Well now you can with ease.</span>--}}
                    {{--</p>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<img class="img-responsive m-t-lg app-block-game-img" src="/assets/www/img/iphone-flat-sized.jpg">--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
          {{--<div class="item">--}}
            {{--<div class="block">--}}
              {{--<div class="container">--}}
                {{--<div class="row">--}}
                  {{--<div class="col-sm-8 col-sm-offset-2">--}}
                    {{--<p class="lead m-x-auto text-center">--}}
                      {{--Instead of guessing how much time you spend on each of your tasks, why not have automagically record everything and have easy reporting without lifting a finger? <span class="hidden-xs">Well now you can with ease.</span>--}}
                    {{--</p>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<img class="img-responsive m-t-lg app-block-game-img" src="/assets/www/img/iphone-flat-sized.jpg">--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
        {{--<a class="left carousel-control" href="#carousel-example-generic-2" role="button" data-slide="prev">--}}
          {{--<span class="icon icon-chevron-thin-left" aria-hidden="true"></span>--}}
          {{--<span class="sr-only">Previous</span>--}}
        {{--</a>--}}
        {{--<a class="right carousel-control" href="#carousel-example-generic-2" role="button" data-slide="next">--}}
          {{--<span class="icon icon-chevron-thin-right" aria-hidden="true"></span>--}}
          {{--<span class="sr-only">Next</span>--}}
        {{--</a>--}}
      {{--</div>--}}
    {{--</div>--}}

    <a name="pricing"></a>



    <div class="block block-inverse text-center">
        <p class="h3 m-b-0">
          Capture the collective knowledge of your community.<br><br><strong>Join our early access program today!</strong>
        </p>
    </div>

    <div class="block block-inverse block-bordered block-bordered-lg text-center">

        <div class="lead">Starting at only</div>
        <div class="h1 m-b-md">
          <strong class="text-ribbon text-ribbon-primary">
            <span class="text-nowrap">$500 / Year *</span>
          </strong>
        </div>
        <div class="lead">Limited Time Offer</div>
        <button class="btn btn-warning-outline btn-lg btn-pill m-b" data-toggle="modal" data-target=".app-modal-signup">CREATE YOUR BUDGET <span class="icon icon-chevron-right"></span></button>
        <div class="text-muted text-asterisk">* Discounts available for multi-year commitment. Price does not include one-time setup fee.</div>

    </div>


    <div class="block app-block-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-2 m-b">
            <ul class="list-unstyled list-spaced">
              <li><h6 class="text-uppercase">Product</h6></li>
              <li><a href="#" data-toggle="modal" data-target=".app-modal-video" data-video-id="06HNzs6J3_g">Demo</a></li>
              <li><a href="#features">Features</a></li>
              <li><a href="#pricing">Pricing</a></li>
              {{--<li><a href="#">Roadmap</a></li>--}}
              {{--<li><a href="#">Terms & Conditions</a></li>--}}
            </ul>
          </div>
          {{--<div class="col-sm-2 m-b">--}}
            {{--<ul class="list-unstyled list-spaced">--}}
              {{--<li><h6 class="text-uppercase">Extras</h6></li>--}}
              {{--<li>AutotuneU</li>--}}
              {{--<li>Freestyler</li>--}}
              {{--<li>Chillaxation</li>--}}
            {{--</ul>--}}
          {{--</div>--}}
          <div class="col-sm-2 m-b">
            <ul class="list-unstyled list-spaced">
              <li><h6 class="text-uppercase">Organization</h6></li>
              {{--<li><a href="#">Our Story</a></li>--}}
              <li><a href="#" data-toggle="modal" data-target=".app-modal-signup">Contact Us</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
          </div>
           <div class="col-sm-6 col-sm-offset-2">
            <h6 class="text-uppercase">About</h6>
            <p>The People's Budget was created by the PB NOLA campaign of the <a href="http://cbno.org" target="_blank" rel="nofollow">Committee for a Better New Orleans</a>. PB NOLA is made up of community members, non-profit organizations and civic groups who advocate for better resident engagement in the city budgeting process.</p>
          </div>
        </div>
      </div>
    </div>

    <a class="to-top" style="display: block;" href="#">Back to top</a>

    @include('www.partials.dialogs.form-login')
    @include('www.partials.dialogs.form-signup')
    @include('www.partials.dialogs.youtube-video')

    <script src="/assets/www/vendor/jquery.min.js"></script>
    <script src="/assets/www/js/main.min.js"></script>
    {{--<script src="/assets/www/js/app.js"></script>--}}
  </body>
</html>