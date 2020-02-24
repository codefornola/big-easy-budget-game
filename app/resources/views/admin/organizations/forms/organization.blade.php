@section('assets')
  @parent
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/medium-editor.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/bootstrap.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/peoples-budget-tweaks.css">
@endsection

@section('deferred')
  @parent
  <script src="/bower_components/medium-editor/dist/js/medium-editor.min.js"></script>
  <script src="/assets/admin/js/divisions-form.js"></script>
  <script>
    $('.editable').each(function(i){
      var $field = $(this);
      var placeholderText = $field.data('placeholderText') || '';
      $field.data('medium', new MediumEditor($field[0], {toolbar: { buttons: ['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote', 'image'] }, anchor: { targetCheckbox: true }, buttonLabels: 'fontawesome', placeholder: {text: placeholderText}}));
    });
  </script>
@endsection

<fieldset>

  {!! Form::hidden('budget_id', $budget->id); !!}

  <div class="form-group form-group-lg">
    {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::text('name', null, ['placeholder' => 'Ex: Department of Recreation', 'class' => 'form-control input-md required']); !!}
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('category_id', 'Category', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::select('category_id', $budget->categories()->orderBy('name')->lists('name', '_id'), null, ['placeholder' => 'Pick a category...', 'class' => 'form-control']); !!}
      <span class="help-block">Optional</span>
    </div>
  </div>

  <hr>

  <div class="form-group form-group-lg">
    {!! Form::label('units_min', 'Minimum Budget', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      {!! Form::text('units_min', null, ['placeholder' => 'Ex: 25', 'class' => 'form-control input-md required']); !!}
      <span class="help-block">Tip: In "units" not "dollars"</span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('units_previous_period', 'Last Year\'s Budget', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      {!! Form::text('units_previous_period', null, ['placeholder' => 'Ex: 32', 'class' => 'form-control input-md required']); !!}
      <span class="help-block">Tip: Also in "units" not "dollars"</span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('units_other_funding', 'Other Funds', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      {!! Form::text('units_other_funding', null, ['placeholder' => 'Ex: 20', 'class' => 'form-control input-md required']); !!}
      <span class="help-block">Tip: Again in "units" not "dollars"</span>
    </div>
  </div>

  <hr>

  <div class="form-group form-group-lg">
    {!! Form::label('brief', 'Header Photo', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-3">
      <div class="input-group">
        <span class="input-group-btn">
          <span class="btn btn-primary btn-lg btn-file">
          Browse ... {!! Form::file('photo'); !!}
          </span>
          </span>
          <input type="text" class="form-control" readonly>
      </div>
      <span class="help-block"><b>Photos will be intelligently resized to fit the dimensions:</b> 360px &times; 180px<br><br>This photo is used as the organization's background header. Thus, the photo may not be entirely visible when in use.</span>
    </div>
    <div class="col-md-6">
        <div class="img-preview img-preview-org-header" style="@if(!empty($organization) && $organization->headerImgExists()) background-image: url('{{$organization->headerImgPath()}}?{{rand(10000,99999)}}') @endif "> @unless(!empty($organization) && $organization->headerImgExists())No photo yet @endunless</div>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('brief', 'Brief Description', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::text('brief', null, ['class' => 'form-control input-md']); !!}
      <span class="help-block">One-liner describing general responsibilities</span>
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('description', 'Full Description', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-9">
      {!! Form::textarea('description', null, ['class' => 'editable']); !!}
      <span class="help-block">Full description when user requests to "learn more"</span>
    </div>
  </div>

  <div class="box-subtitle with-border">Divisions</div>
  @include('admin.organizations.forms.division')

  <div class="box-subtitle with-border">Poll</div>
  @include('admin.organizations.forms.poll')

  <hr>

  <div class="form-group form-group-lg">
    <div class="col-md-4 col-md-offset-3">
      {!! Form::button((isset($organization) ? 'Update Organization' : 'Add Organization'), ['type' => 'button', 'id'=>'submitBtn', 'class' => 'btn btn-lg btn-primary']); !!}
    </div>
  </div>

</fieldset>
