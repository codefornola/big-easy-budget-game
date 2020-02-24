@if(count($errors))
	<div class="alert alert-danger">
	{!! implode('<br>', $errors->all()); !!}
	</div>
@endif