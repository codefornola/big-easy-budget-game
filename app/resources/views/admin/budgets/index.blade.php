@extends('layout.admin')

@section('deferred')
	@parent
	<script src="/assets/admin/js/item-list.js"></script>
@endsection

@section('content')
	@if(isset($budgets) && !$budgets->isEmpty())
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Budgets</h3>
				<div class="pull-right box-tools">
					<a href="{{ route('admin.budgets.create') }}" class="btn btn-success btn-flat-right"><i class="fa fa-plus"></i> New Budget</a>
				</div>
            </div>
			<div class="box-body table-responsive no-padding">
				@include('admin.budgets.sections.list')
			</div>
		</div>
	@else
		@include('admin.partials.no-data', ['message' => 'To get started, <a href="'. route('admin.budgets.create') .'">create a budget</a>.'])
	@endif
@endsection