<table class="table table-striped" id="OrganizationTable">
    @include('admin.partials.csrf_token_js_var')
    <tr>
        <th style="width: 200px">Name</th>
        <th class="text-center hidden-xs" style="width: 80px">Min.</th>
        <th>Category</th>
        {{--<th class="text-center" style="width: 80px">Users</th>--}}
        {{--<th class="text-center hidden-xs" style="width: 80px">Opened</th>--}}
        {{--<th class="text-center hidden-xs" style="width: 80px">Closed</th>--}}
        <th class="text-center" style="width: 10%"></th>
    </tr>
    @foreach($organizations as $org)
    <tr class="item-row" data-id="{{$org->id}}">
        <td><a href="{{ route('admin.budgets.organizations.edit', [$org->budget_id, $org->id]) }}">{{$org->name}}</a></td>
        <td class="text-center hidden-xs">{{$org->units_min}}</td>
        <td>{{$org->category->name or ''}}</td>
    {{--<td class="text-center">0</td>--}}{{--{{$budget->submissions()->count()}}--}}
{{--        <td class="text-center hidden-xs">{{$budget->opened_at or '-'}}</td>--}}
{{--        <td class="text-center hidden-xs">{{$budget->closed_at or '-'}}</td>--}}
        <td class="text-right"><a data-method="DELETE" data-action="{{ route('admin.budgets.organizations.destroy', [$budget->id, $org->id]) }}" data-update-replace="#OrganizationTable" class="btn btn-danger btn-xs actionable"><i class="fa fa-times"></i></a></td>
    </tr>
    @endforeach
</table>