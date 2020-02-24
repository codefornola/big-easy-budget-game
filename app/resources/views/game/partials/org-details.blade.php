<div class="pb-org-details text-left">
	@if(!empty($org->description))
	<div class="pb-org-desc">
		{!! $org->description !!}
	</div>
	@endif
	@if($org->divisions()->count())
	<div class="pb-org-divisions">
		<div class="pb-org-divisions-title">Divisions</div>
		<div class="pb-org-divisions-list">
			@foreach($org->divisions as $division)
			<div class="row pb-org-division clearfix">
				<div class="col-sm-4"><b>{{$division->name}}</b></div>
				<div class="col-sm-8">{!! $division->tooltip !!}</div>
			</div>
			@endforeach
		</div>
	</div>
	@endif
</div>