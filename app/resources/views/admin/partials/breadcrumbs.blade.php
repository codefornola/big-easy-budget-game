@if(!empty($crumbs))
	<ol class="breadcrumb">
        @foreach($crumbs as $url=>$name)
			@if(last(array_keys($crumbs)) == $url)
				<li class="active">{!! $name !!}</li>
			@else
				<li><a href="{{ $url }}" class="active">{!! $name !!}</a></li>
			@endif
		@endforeach
    </ol>
@endif