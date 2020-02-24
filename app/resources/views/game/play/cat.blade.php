<div class="pb-cat clearfix">
	<h2 class="pb-cat-header l" style="background:{{$category->color}}">{{$category->name}}</h2>
	@if(!empty($category->description))
	<div class="pb-cat-desc">
		<div class="container text">{!!$category->description!!}</div>
	</div>
	@endif
	<div class="container">
		<div class="row row-auto pb-cards">
		@foreach($organizations as $org)
			@include('game.play.card')
			<?php $pollJson->add($org->id, $org->poll); ?>
			<?php $indexer->increment()?>
		@endforeach
		</div>
	</div>
</div>
