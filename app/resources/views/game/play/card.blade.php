<div class="col-sm-6 col-md-4">

	<div class="pb-card" data-min-budget="{{$org->units_min}}" data-id="{{$org->id}}">

		<div class="org-header" @if($org->headerImgExists())style="background-image: url('{{$org->headerImgPath()}}');" @endif>
			<span class="org-count">{{$indexer->real()}} of {{number_format($budget->organizations()->count())}}</span>
		</div>

		<div class="org-budget-ctrl">
			<div class="org-budget-input-wrap">
		        <input name="org[{{$org->id}}][units]" class="org-budget-input" type="number">
			</div>
		    <a class="pb-btn pb-btn-circle pb-btn-green plus-a" data-delta="1">+1</a>
		    <a class="pb-btn pb-btn-circle pb-btn-green plus-b" data-delta="10">+10</a>
			<a class="pb-btn pb-btn-circle pb-btn-red minus-a" data-delta="-1">-1</a>
		    <a class="pb-btn pb-btn-circle pb-btn-red minus-b" data-delta="-10">-10</a>
		</div>

		<h3 class="org-name">{{$org->name}}</h3>
		<div class="org-unit-references">Last Year: <span class="number">{{$org->units_previous_period}}</span> | Min: <span class="number">{{$org->units_min}}</span>@if($org->units_other_funding !== null) | <a class="org-link-other-funds" data-toggle="tooltip" data-placement="top" title="Other funds come from federal, state and private sources. You cannot choose how to spend them because they are dedicated to certain projects.">Other Funds: <span class="number">{{$org->units_other_funding or "0"}}</span></a>@endif</div>
		<p class="org-brief">{{$org->brief}}</p>
		<div class="org-actions">

			<hr>
			<a class="pb-btn pb-btn-blue org-btn-details">Learn More</a>
			@if($org->poll)
			<a class="pb-btn pb-btn-purple org-btn-poll">Quick Poll</a>
			@endif
		</div>

	</div>

</div>