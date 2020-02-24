@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Budget Settings</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			{!! Form::model($budget, ['route' => ['admin.budgets.update', $budget->id], 'method'=>'put', 'class' => 'form-horizontal']) !!}
				{{--{!! Form::hidden('id', $budget->id) !!}--}}
				@include('admin.budgets.forms.budget')
			{!! Form::close() !!}
		</div>
	</div>


@endsection