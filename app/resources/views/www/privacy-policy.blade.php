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

    <title>Privacy Policy | The People's Budget | Crowd-sourced budget planning</title>

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

<div class="block">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 m-b-lg">
                <h1>Privacy Policy</h1>
                @include('www.partials.text.privacy-policy-text')
            </div>
        </div>
    </div>
</div>


@include('www.partials.dialogs.form-login')
@include('www.partials.dialogs.form-signup')
@include('www.partials.dialogs.youtube-video')

<script src="/assets/www/vendor/jquery.min.js"></script>
<script src="/assets/www/js/main.min.js"></script>

</body>
</html>