@if (session('message'))
	<div class="alert alert-{{session('alertType', 'success')}}">
        {!! session('message') !!}
    </div>
@endif