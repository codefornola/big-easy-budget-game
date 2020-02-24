@extends('layout.admin')

@section('deferred')
	@parent
	<script src="/assets/admin/js/item-list.js"></script>
@endsection

@section('content')
	@if(isset($categories) && !$categories->isEmpty())
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Org. Categories</h3>
				<div class="pull-right box-tools">
					<a href="{{ route('admin.budgets.categories.create', $budget->id) }}" class="btn btn-success btn-flat-right"><i class="fa fa-plus"></i> New<span class="hidden-xs"> Category</span></a>
				</div>
            </div>
			<div class="box-body table-responsive no-padding">
				@include('admin.categories.sections.list')
			</div>
		</div>
	@else
		@include('admin.partials.no-data', ['message' => '<a href="'. route('admin.budgets.categories.create', [$budget->id]) .'">Create a category</a> to group similar organizations.'])
	@endif
@endsection