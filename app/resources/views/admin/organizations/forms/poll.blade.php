<fieldset>

  <div class="form-group form-group-lg">
    {!! Form::label('question', 'Question', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-9">
      {!! Form::text('question', $poll['question'], ['placeholder' => 'Ex: What needs the most improvement?', 'class' => 'form-control input-md']); !!}
    </div>
  </div>

  <div class="form-group form-group-lg addon-sm">
    {!! Form::label('option_a', 'Answer Options', ['class' => 'col-md-3 control-label control-label-lg']) !!}
    <div class="col-md-6">
      <div class="input-group">
        <span class="input-group-addon">A</span>
        {!! Form::text('option_a', $poll['option_a'], ['placeholder' => 'Ex: Roads', 'class' => 'form-control input-md']); !!}
      </div>
      <div class="input-group">
        <span class="input-group-addon">B</span>
        {!! Form::text('option_b', $poll['option_b'], ['placeholder' => 'Ex: Parks', 'class' => 'form-control input-md']); !!}
      </div>
      <div class="input-group">
        <span class="input-group-addon">C</span>
        {!! Form::text('option_c', $poll['option_c'], ['placeholder' => 'Ex: Sewage', 'class' => 'form-control input-md']); !!}
      </div>
      <div class="input-group">
        <span class="input-group-addon">D</span>
        {!! Form::text('option_d', $poll['option_d'], ['placeholder' => '', 'class' => 'form-control input-md']); !!}
      </div>
      <div class="input-group">
        <span class="input-group-addon">E</span>
        {!! Form::text('option_e', $poll['option_e'], ['placeholder' => '', 'class' => 'form-control input-md']); !!}
      </div>
    </div>
  </div>

  <div class="form-group form-group-lg">
    <div class="col-md-6 col-md-offset-3">

      <div class="input-group input-group-lg">
         <span class="input-group-addon input-group-checkbox">{!! Form::checkbox('disable_other', '1', (isset($poll['disable_other']) && $poll['disable_other']), ['id'=>'disable_other']); !!}</span>
        {!! Form::label('disable_other', 'Disable "Other" answer option for this poll', ['class' => 'input-group-addon input-group-fill']) !!}
      </div><br>

    </div>
  </div>

</fieldset>