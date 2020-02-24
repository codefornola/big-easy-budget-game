@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Category</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			{!! Form::model($category, ['route' => ['admin.budgets.categories.update', $budget->id, $category->id], 'method'=>'put', 'class' => 'form-horizontal']) !!}
			@include('admin.categories.forms.category')
			{!! Form::close() !!}
		</div>
	</div>


@endsection