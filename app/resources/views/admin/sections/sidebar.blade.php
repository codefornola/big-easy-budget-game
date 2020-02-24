      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">MENU</li>
              @foreach($nav as $item)
	          <li class="{{ Route::is($item['routeMatch']) ? 'active' : '' }}"><a href="{{ route($item['route'], $item['routeId']) }}" class="{{$item['linkClass']}}"><i class="{{ $item['iconClass'] }}"></i> <span>{{ $item['label'] }}</span></a></li>
              @endforeach

            {{--<li><a href="#"><i class="ion ion-ios-people"></i> <span>Organizations</span></a></li>--}}
            {{--<li class="treeview">--}}
              {{--<a href="#"><i class="ion ion-pie-graph"></i> <span>Results</span><i class="fa fa-caret-left pull-right"></i></a>--}}
              {{--<ul class="treeview-menu">--}}
                {{--<li><a href="#">Link in level 2</a></li>--}}
                {{--<li><a href="#">Link in level 2</a></li>--}}
              {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="#"><i class="ion ion-play"></i> <span>Start</span></a></li>--}}
            {{--<li><a href="#"><i class="ion ion-pause"></i> <span>Pause</span></a></li>--}}
            {{--<li><a href="#"><i class="ion ion-android-options"></i> <span>Settings</span></a></li>--}}

          </ul>
        </section>
      </aside>