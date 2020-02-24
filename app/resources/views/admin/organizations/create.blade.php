@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Add an Organization</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			{!! Form::open(array('route' => array('admin.budgets.organizations.store', $budget->id), 'class' => 'form-horizontal', 'files' => true)) !!}
				{{ csrf_field() }}
				@include('admin.organizations.forms.organization')
			{!! Form::close() !!}
		</div>
	</div>


@endsection