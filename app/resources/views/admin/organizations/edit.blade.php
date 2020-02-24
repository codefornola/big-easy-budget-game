@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Editing: {{ $organization->name }}</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			{!! Form::model($organization, ['route' => ['admin.budgets.organizations.update', $budget->id, $organization->id], 'method'=>'put', 'class' => 'form-horizontal', 'files' => true]) !!}
				@include('admin.organizations.forms.organization')
			{!! Form::close() !!}
		</div>
	</div>

@endsection