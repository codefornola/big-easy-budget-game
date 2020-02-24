@extends('layout.admin')

@section('content')

	<div class="box box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Create a New Budget</h3>
		</div>
		<div class="box-body">
			@include('admin.partials.errors')
			<form class="form-horizontal" method="post" action="{{ route('admin.budgets.store') }}">
			@include('admin.budgets.forms.budget')
			</form>
		</div>
	</div>


@endsection