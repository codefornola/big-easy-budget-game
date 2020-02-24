@section('assets')
  @parent
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/medium-editor.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/bootstrap.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/peoples-budget-tweaks.css">
@endsection

@section('deferred')
  @parent
  <script src="/bower_components/medium-editor/dist/js/medium-editor.min.js"></script>
  <script>
    var elements = document.querySelectorAll('.editable'),
      editor = new MediumEditor(elements, {toolbar: { buttons: ['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote', 'image'] }, anchor: { targetCheckbox: true }, buttonLabels: 'fontawesome'});
  </script>
@endsection

<fieldset>

  {{ csrf_field() }}

  <div class="form-group form-group-lg">
    {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::text('name', null, ['placeholder' => 'Ex: '.(intval(date("Y"))+1).' City Budget', 'class' => 'form-control input-md required']); !!}
    <span class="help-block">Tip: Be descriptive and include the year</span>
    </div>
  </div>

  @if(empty($budget))
  <div class="form-group form-group-lg">
      {!! Form::label('clone_budget_id', 'Copy Organization Data from:', ['class' => 'col-md-3 control-label control-label-lg']) !!}
      <div class="col-md-6">
      {!! Form::select('clone_budget_id', App\Models\Budget::all()->sortBy('name')->lists('name', '_id'), null, ['placeholder' => 'Pick a budget...', 'class' => 'form-control']); !!}
    </div>
  </div>
  @endif
  <hr>

  <div class="form-group form-group-lg">
    {!! Form::label('units_label', 'Unit Label', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      {!! Form::text('units_label', null, ['placeholder' => 'Ex: dollar, coin, point', 'class' => 'form-control input-md required']); !!}
    <span class="help-block">What type of "unit" is being spent?</span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('units_value', 'Unit Value', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">$</span>
        {!! Form::text('units_value', null, ['placeholder' => 'Ex: 1000000', 'class' => 'form-control input-md required']); !!}
      </div>
      <p class="help-block">Amount each "unit" is worth in dollars</p>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('units_total', 'Total Units', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
        {!! Form::text('units_total', null, ['placeholder' => '250', 'class' => 'form-control input-md required']); !!}
        <span class="help-block">Number of "units" to spend on the budget</span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    <div class="col-md-6 col-md-offset-3">

      <div class="input-group input-group-lg">
         <span class="input-group-addon input-group-checkbox">{!! Form::checkbox('require_spend_all', '1', true, ['id'=>'require_spend_all']); !!}</span>
        {!! Form::label('require_spend_all', 'Require users to spend entire budget?', ['class' => 'input-group-addon input-group-fill']) !!}
      </div><br>

    </div>
  </div>
  <hr>

  <div class="form-group form-group-lg">
    {!! Form::label('video_id', 'YouTube Video Id', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon">http://youtu.be/</span>
        {!! Form::text('video_id', null, ['class' => 'form-control']); !!}
      </div>
      {{--<p class="help-block"><a href="#">How do I find this?</a></p>--}}
      <span class="help-block"><b>Tip:</b> https://www.youtube.com/watch?v=<b>video_id_here</b> </span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('survey_id', 'Survey Id', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::text('survey_id', null, ['class' => 'form-control input-md']); !!}
      <span class="help-block"><b>Tip:</b> https://username.typeform.com/to/<b>survey_id_here</b> </span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('description', 'Home screen explanation', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {{--<div class="editable">Whatever!</div>--}}
      {!! Form::textarea('description', null, ['class' => 'editable']); !!}
    </div>
  </div>

  <div class="form-group form-group-lg">
    <div class="col-md-4 col-md-offset-3">
      {!! Form::button((isset($budget) ? 'Update Budget' : 'Add Budget'), ['type' => 'submit', 'id'=>'submit', 'class' => 'btn btn-lg btn-primary']); !!}
    </div>
  </div>

</fieldset>
