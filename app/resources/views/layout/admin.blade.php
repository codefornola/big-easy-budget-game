<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>People's Budget | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('assets')
      <link href="https://fonts.googleapis.com/css?family=Lato:400,300,700,400italic,300italic|Sansita+One" rel="stylesheet">
      <link href="/bower_components/admin-lte/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
      <link rel="stylesheet" href="/bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css">
      <link href="/assets/admin/css/main.css" rel="stylesheet" type="text/css"/>
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    @show
  </head>
  <body class="skin-green">
    <div class="wrapper">

      @include('admin.sections.header')
      @include('admin.sections.sidebar')
      @include('admin.sections.main')
      @include('admin.sections.footer')
      @include('admin.sections.rightbar')

    </div><!-- ./wrapper -->

    @section('deferred')
    <!-- REQUIRED JS SCRIPTS -->
    <script src="/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="/bower_components/admin-lte/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/bower_components/admin-lte/dist/js/app.min.js" type="text/javascript"></script>
    <script src="/bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>
    {{--<script src="/assets/vendor/flavr/js/flavr.min.js"></script>--}}
    <script src="/assets/admin/js/app.js" type="text/javascript"></script>
    @show
  </body>
</html>
