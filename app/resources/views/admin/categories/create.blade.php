@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Create a New Category</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			{!! Form::open(array('route' => array('admin.budgets.categories.store', $budget->id), 'class' => 'form-horizontal')) !!}
			{{ csrf_field() }}
			@include('admin.categories.forms.category')
			{!! Form::close() !!}
		</div>
	</div>


@endsection