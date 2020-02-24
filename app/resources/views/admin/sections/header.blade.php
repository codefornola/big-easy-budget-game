<!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">T<b>PB</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle visible-xs" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <i class="fa fa-user"></i>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    @if(!empty(Auth::user()->avatar))
                    <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image"/>
                    @endif
                    <p>
                      {{ Auth::user()->name }}
                    </p>
                  </li>
                  {{--<!-- Menu Body -->--}}
                  {{--<li class="user-body">--}}
                    {{--<div class="col-xs-4 text-center">--}}
                      {{--<a href="#">Followers</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                      {{--<a href="#">Sales</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-4 text-center">--}}
                      {{--<a href="#">Friends</a>--}}
                    {{--</div>--}}
                  {{--</li>--}}
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/auth/edit" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              {{--<li>--}}
                {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-question-circle"></i></a>--}}
              {{--</li>--}}
            </ul>
          </div>

          @include('admin.partials.breadcrumbs')
        </nav>

      </header>