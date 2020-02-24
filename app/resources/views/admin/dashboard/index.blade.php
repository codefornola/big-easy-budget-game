@extends('layout.admin')

@section('content')
	@if(isset($budgets) && !$budgets->isEmpty())
		@include('admin.partials.no-data', ['message' => '<b>Welcome back, '.Auth::user()->name.'!</b><br><a href="'. route('admin.budgets.index') .'">Select a budget</a> to review.'])
	@else
		@include('admin.partials.no-data', ['message' => 'To get started, <a href="'. route('admin.budgets.create') .'">create a budget</a>.'])
	@endif
@endsection