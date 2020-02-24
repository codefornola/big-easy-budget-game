<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', app('Account')->city.", " .app('Account')->state) | People's Budget | You're mayor for a day.</title>
        <meta name="description" content="A budget planning, game-like tool for the citizens of {{app('Account')->city}}, {{app('Account')->state}}.">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <meta property="og:url" content="{{app('Account')->url()}}">
        <meta property="og:site_name" content="People's Budget | {{app('Account')->city}}, {{app('Account')->state}}">
        <meta property="og:image" content="{{app('Account')->url() . app('Account')->bannerImg()}}">
        <meta property="og:title" content="You're mayor for a day.">
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="article">
        <meta property="og:description" content="A budget planning, game-like tool for the citizens of {{app('Account')->city}}, {{app('Account')->state}}.">

        <script>var PB_ACCOUNT = '{{app('Account')->slug}}';</script>
        @section('assets')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,400italic,300italic|Sansita+One" rel="stylesheet">
        <link rel="stylesheet" href="/bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css">
        <link rel="stylesheet" href="/bower_components/jssocials/dist/jssocials.css">
        <link rel="stylesheet" href="/bower_components/jssocials/dist/jssocials-theme-flat.css">
        <link href="/assets/game/css/auth.css" rel="stylesheet" type="text/css">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:141300,hjsv:5};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
            @if(Auth::check())
                hj('tagRecording', ['Logged In User']);
            @endif
        </script>
        <script>var authStatus = {!! Auth::check() ? 'true' : 'false' !!};</script>
        @show
    </head>
    <body class="lato">

        <div class="screen">
        @yield('grid')
        </div>

        @include('auth.login-box')
        @section('deferred')
        <!-- REQUIRED JS SCRIPTS -->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="/assets/vendor/fastclick/fastclick.min.js"></script>
        <script src="/bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
        <script src="/bower_components/jssocials/dist/jssocials.min.js"></script>
        <script src="/assets/js/common.js"></script>
        @show
    </body>
</html>