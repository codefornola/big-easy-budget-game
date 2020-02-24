<table class="table table-striped" id="BudgetTable">
    @include('admin.partials.csrf_token_js_var')
    <tr>
        <th>Name</th>
        <th class="text-center" style="width: 80px">Status</th>
        <th class="text-center hidden-xs" style="width: 80px">Users</th>
        <th class="text-center hidden-xs" style="width: 80px">Opened</th>
        <th class="text-center hidden-xs" style="width: 80px">Closed</th>
        <th class="text-center" style="width: 80px"></th>
    </tr>
    @foreach($budgets as $budget)
    <tr class="item-row" data-id="{{$budget->id}}">
        <td><a href="{{ !is_null($budget->opened_at) ? route('admin.budgets.show', [$budget->id]) : route('admin.budgets.organizations.index', [$budget->id]) }}">{{$budget->name}}</a></td>
        <td class="text-center"><span class="label label-{{$budget->statusClass()}}">{{strtoupper($budget->status())}}</span></td>
        <td class="text-center hidden-xs">0</td>{{--{{$budget->submissions()->count()}}--}}
        <td class="text-center hidden-xs">{{ isset($budget->opened_at) ? $budget->opened_at->format('n-j-y')  : '-' }}</td>
        <td class="text-center hidden-xs">{{isset($budget->closed_at) ? $budget->opened_at->format('n-j-y') : '-' }}</td>
        <td class="text-right"><a data-method="DELETE" data-action="{{ route('admin.budgets.destroy', [$budget->id]) }}" data-update-replace="#BudgetTable" class="btn btn-danger btn-xs actionable"><i class="fa fa-times"></i></a></td>
    </tr>
    @endforeach
</table>