@extends('layout.admin')

@section('deferred')
	@parent
	<script src="/assets/admin/js/item-list.js"></script>
@endsection

@section('content')
	@if(isset($organizations) && !$organizations->isEmpty())
		<div class="box box-solid">
			<div class="box-header">
				<h3 class="box-title">Organizations</h3>
				<div class="pull-right box-tools">
					<a href="{{ route('admin.budgets.organizations.create', [$budget->id]) }}" class="btn btn-success btn-flat-right"><i class="fa fa-plus"></i> New<span class="hidden-xs"> Organization</span></a>
				</div>
            </div>
			<div class="box-body table-responsive no-padding">
				@include('admin.organizations.sections.list')
			</div>
		</div>
	@else
		@include('admin.partials.no-data', ['message' => 'The next step is to <a href="'. route('admin.budgets.organizations.create', [$budget->id]) .'">add an organization</a>.'])
	@endif
@endsection