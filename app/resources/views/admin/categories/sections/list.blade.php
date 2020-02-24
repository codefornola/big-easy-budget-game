<table class="table table-striped" id="CategoryTable">
    @include('admin.partials.csrf_token_js_var')
    <tr>
        <th class="text-center" style="width: 40px"></th>
        <th>Name</th>
        {{--<th class="text-center" style="width: 80px">Users</th>--}}
        {{--<th class="text-center hidden-xs" style="width: 80px">Opened</th>--}}
        {{--<th class="text-center hidden-xs" style="width: 80px">Closed</th>--}}
        <th class="text-center" style="width: 10%"></th>
    </tr>
    @foreach($categories as $cat)
        <tr class="item-row" data-id="{{$cat->id}}">
            <td style="background-color:{{$cat->color}}">&nbsp;</td>
            <td><a href="{{ route('admin.budgets.categories.edit', [$cat->budget_id, $cat->id]) }}">{{$cat->name}}</a></td>
            <td class="text-right"><a data-method="DELETE" data-action="{{ route('admin.budgets.categories.destroy', [$budget->id, $cat->id]) }}" data-update-replace="#CategoryTable" class="btn btn-danger btn-xs actionable"><i class="fa fa-times"></i></a></td>
    </tr>
    @endforeach
</table>