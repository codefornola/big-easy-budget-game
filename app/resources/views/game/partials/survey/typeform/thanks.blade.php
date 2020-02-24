@extends('layout.default')

@section('assets')
	@parent
	<link href="/assets/game/css/main.css" rel="stylesheet" type="text/css">
@endsection

@section('grid')

	@include('game.partials.survey.'.env('SURVEY_PROVIDER').'.embed', ['surveyAccount'=>env('SURVEY_ACCOUNT_ID'), 'surveyId'=>$budget->survey_id, 'height'=>'auto'])

	<div id="TypeformFinishPopup" class="hidden">
		<p>Just as important as your budget is the general feedback we receive in the following brief survey.</p>
		<p><b>Please take 3 minutes to take our survey.</b>
		<br>Hide this dialog and press "start" to begin.</p>
		<p>We truly appreciate your participation!</p>
		@include('partials.social-share', [
			'text' => '<b>Don\'t forget to share your experience:</b> ',
			'iconSize' => 'sm'
		])
	</div>

@endsection

@section('deferred')
	@parent
	<script src="/assets/vendor/typeform/embed.js"></script>
	<script>
	$(document).on('ready', function(){
		BootstrapDialog.show({
			title: "You're Almost Done ...",
			type: BootstrapDialog.TYPE_DEFAULT,
			size: BootstrapDialog.SIZE_SMALL,
			message: $('#TypeformFinishPopup').html(),
			nl2br: false,
			cssClass: 'thanks-dialog',
			buttons: [{
				label: 'Hide',
				cssClass: 'btn-default',
				action: function(dialog){
					dialog.close();
				}
			}],
			autodestroy: false
		});
	});
	</script>

@endsection