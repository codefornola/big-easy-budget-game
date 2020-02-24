      <div class="content-wrapper">
        @if(!empty($title)) @include('admin.partials.content-header') @endif
        <section class="content">
          @include('admin.partials.alert')
          @yield('content', '')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->