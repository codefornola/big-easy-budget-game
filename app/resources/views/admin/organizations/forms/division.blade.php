<fieldset id="division-form-fieldset">

	<div class="form-group form-group-lg">
		<div class="col-md-3">
			<label class="control-label control-label-lg">Name</label>
			{!! Form::text('name_input', null, ['placeholder' => 'Ex: Engineering Division', 'class' => 'form-control input-md', 'id' => 'division-name']); !!}
		</div>
		<div class="col-md-7">
			<label class="control-label control-label-lg">Tooltip</label>
			{!! Form::textarea('tooltip_input', null, ['data-placeholder-text' => 'Ex: Provides technical and admin services for planning and executing of improvement projects', 'class' => 'editable', 'id' => 'division-tooltip']); !!}
		</div>
		<div class="col-md-2">
			<label class="control-label control-label-lg">&nbsp;</label>
			{!! Form::button('<i class="fa fa-fw fa-plus"></i> Add', ['type' => 'button', 'id'=>'division-btn-add', 'class' => 'btn btn-lg btn-success btn-block']); !!}
		</div>
	</div>

	<section id="division-item-template" class="hidden">
		<div class="box-collection-row division-row clearfix">
			<input type="hidden" data-name="divisions[:num:][name]" class="input-name">
			<input type="hidden" data-name="divisions[:num:][tooltip]" class="input-tooltip">
			<div class="col-md-3 col-xs-8 display-name"></div>
			<div class="col-md-7 hidden-xs hidden-sm display-tooltip"></div>
			<div class="col-md-2 col-xs-4">
				{!! Form::button('<i class="fa fa-pencil"></i>', ['type' => 'button', 'class' => 'btn btn-primary division-btn-edit btn-pad-left']); !!}
				{!! Form::button('<i class="fa fa-minus"></i>', ['type' => 'button', 'class' => 'btn btn-danger division-btn-remove btn-pad-left']); !!}
			</div>
		</div>
	</section>

	<div class="box-collection" id="division-collection">
		@if(!empty($divisions))
			@foreach($divisions as $key => $division)
				<div class="box-collection-row division-row clearfix">
					<input type="hidden" name="divisions[{{$key}}][name]" class="input-name" value="{{$division['name']}}">
					<input type="hidden" name="divisions[{{$key}}][tooltip]" class="input-tooltip" value="{!! htmlentities($division['tooltip'], ENT_QUOTES, 'UTF-8') !!}">
					<div class="col-md-3 col-xs-8 display-name">{{$division['name']}}</div>
					<div class="col-md-7 hidden-xs hidden-sm display-tooltip">{!! $division['tooltip'] !!}</div>
					<div class="col-md-2 col-xs-4">
						{!! Form::button('<i class="fa fa-pencil"></i>', ['type' => 'button', 'class' => 'btn btn-primary division-btn-edit btn-pad-left']); !!}
						{!! Form::button('<i class="fa fa-minus"></i>', ['type' => 'button', 'class' => 'btn btn-danger division-btn-remove btn-pad-left']); !!}
					</div>
				</div>
			@endforeach
		@endif
	</div>

</fieldset>