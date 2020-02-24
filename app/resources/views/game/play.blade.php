@extends('layout.default')

@section('assets')
	@parent
	<script>hj('tagRecording', ['Started Game']);</script>
	<link rel="stylesheet" href="/assets/vendor/flavr/css/animate.css">
	<link href="/assets/game/css/main.css" rel="stylesheet" type="text/css">
@endsection

@section('grid')

<div class="pb-header">
	<h1>{{$budget->name}}</h1>
	{{--<p class="lead">{!!$budget->description!!}</p>--}}
</div>
<div class="pb-tracker">
	<div class="pb-tracker-left-bg"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 text-center">
				<div class="progress-indicator">
				    <svg class="lg-circle" data-dash-offset="364"><g><circle cx="0" cy="0" r="58" class="animated-circle" transform="translate(60,60) rotate(-90)" fill="none" /></g></svg>
					<svg class="sm-circle" data-dash-offset="126"><g><circle cx="0" cy="0" r="20" class="animated-circle" transform="translate(22,22) rotate(-90)" fill="none" /></g></svg>
				    <div class="progress-count">
					    <span class="pb-unspent"></span>
					    <span class="pb-max upper">of {{number_format($budget->units_total)}}</span>
				    </div>
					<div class="unit-label"><span class="unit-label-context">{{ucfirst(strtolower(str_plural($budget->units_label)))}}</span> left to spend</div>
				</div>
			</div>
			<div class="col-sm-6 col-game-rules text-center">
				<div class="game-rules l">
					<p class="unit-value"><b><span class="unit-value-label">1 {{strtolower($budget->units_label)}}</span> = <span class="unit-value-dollars">${{number_format($budget->units_value, 0)}}</span></b></p>
					<p>{{ $budget->require_spend_all ? "Please spend every ".strtolower($budget->units_label)."." : "A surplus (left-over) is allowed." }}<br>You must not go over budget.</p>
					<p>This funds <b>{{number_format($budget->organizations()->count())}} departments</b>.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="pb-msg-box">
</div>

<form class="pb-form unselectable" data-id="{{$budget->id}}" action="{{ route('game.save', [$budget]) }}" method="post">

	{!! csrf_field() !!}
	<input type="hidden" name="budget_id" value="{{$budget->id}}">
	<input type="hidden" name="start_time" value="{{$start_time}}">

	@inject('pollJson', 'App\Services\DictionaryJsonService')
	@inject('indexer', 'App\Services\IteratorIndexService')

	@foreach($budget->categories()->orderBy('name')->get() as $category)
		@include('game.play.cat', [
		'organizations' => $category->organizations()->orderBy('name')->get()
		])
	@endforeach

	@if($budget->uncategorizedOrgs()->count())
		@include('game.play.cat', ['category'=> new \App\Models\Category(['name' => 'Uncategorized', 'color'=>'#666666']), 'organizations' => $budget->uncategorizedOrgs()])
	@endif
	<script>
	<?=$pollJson->filterEmptyField('question')->make('pollDictionary' . $budget->id);?>
	</script>

	@if(!$budget->require_spend_all)
		<div class="surplus">
			<div class="surplus-message">This budget allows you to submit a <b>surplus</b>.</div>
			<button type="button" class="btn btn-lg btn-success surplus-btn js-submit-surplus"><b>Submit</b> a Surplus!</button>
		</div>
	@endif

</form>

@endsection

@section('deferred')
	@parent
	<script src="/bower_components/js-cookie/src/js.cookie.js"></script>
	<script src="/assets/js/pb.js"></script>
	<script>
        $('.pb-form').pb({
	        allowance: {{$budget->units_total}},
	        type: '{{$budget->units_label}}',
	        type_plural: '{{str_plural($budget->units_label)}}',
	        beforeChangeBudget: function($org, delta){
		        hj('tagRecording', ['Changed Org Budget']);
		        console.log('beforeChangeBudget Callback', $org, delta);
	        },
	        beforeViewPoll: function($org, poll){
		        hj('tagRecording', ['Viewed Org Poll']);
		        console.log('beforeViewPoll Callback', $org);
	        },
	        beforeViewDetails: function($org){
		        hj('tagRecording', ['Viewed Org Details']);
		        console.log('beforeViewDetails Callback', $org);
	        },
	        beforeFinishGame: function(){
		        hj('tagRecording', ['Finished Game']);
		        console.log('beforeFinishGame Callback');
	        }
        });
        $(function () {
	        $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection