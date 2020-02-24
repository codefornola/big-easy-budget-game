@section('assets')
  @parent
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/medium-editor.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/bootstrap.css">
  <link rel="stylesheet" href="/bower_components/medium-editor/dist/css/themes/peoples-budget-tweaks.css">
  <link rel="stylesheet" href="/bower_components/jquery-minicolors/jquery.minicolors.css">
@endsection

@section('deferred')
  @parent
  <script src="/bower_components/jquery-minicolors/jquery.minicolors.min.js"></script>
  <script src="/bower_components/medium-editor/dist/js/medium-editor.min.js"></script>
  <script>
    var elements = document.querySelectorAll('.editable'),
      editor = new MediumEditor(elements, {toolbar: { buttons: ['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote', 'image'] }, anchor: { targetCheckbox: true }, buttonLabels: 'fontawesome'});
    $('.minicolor').minicolors();
  </script>
@endsection

<fieldset>

  {!! Form::hidden('budget_id', $budget->id); !!}

  <div class="form-group form-group-lg">
    {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {!! Form::text('name', null, ['placeholder' => 'Ex: Public Safety', 'class' => 'form-control input-md required']); !!}
    </div>
  </div>

  <div class="form-group form-group-lg">
    {!! Form::label('color', 'Label color', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-4">
      {!! Form::text('color', null, ['placeholder' => 'Pick one', 'class' => 'form-control input-md minicolor required']); !!}
    <span class="help-block">Tip: Use bold, vibrant colors (not light shades).</span>
    </div>
  </div>

  <hr>

  <div class="form-group form-group-lg">
    {!! Form::label('description', 'Short description', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      {{--<div class="editable">Whatever!</div>--}}
      {!! Form::textarea('description', null, ['class' => 'editable']); !!}
    </div>
  </div>

  <div class="form-group form-group-lg">
    <div class="col-md-4 col-md-offset-3">
      {!! Form::button((isset($category) ? 'Update Category' : 'Add Category'), ['type' => 'submit', 'id'=>'submit', 'class' => 'btn btn-lg btn-primary']); !!}
    </div>
  </div>

</fieldset>
