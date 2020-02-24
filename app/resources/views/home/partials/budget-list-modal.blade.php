<div id="BudgetListModal" class="budget-list hidden">
	<div class="alert alert-success text-center" style="margin-bottom:15px;">We currently have more than one active budget game to play!</div>
	<div class="text-center" style="margin-bottom:15px;">Choose the one most appropriate for you:</div>
	@if(count($budgets))
		@foreach($budgets as $budget)
			<a class="btn btn-block btn-primary budget-link" style="text-transform: none;" href="/budget/{{$budget->id}}">{{$budget->name}} <span class="fa fa-chevron-circle-right"></span></a>
		@endforeach
	@endif
</div>