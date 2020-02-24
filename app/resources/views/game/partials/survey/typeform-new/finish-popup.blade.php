<div id="TypeformFinishPopup">
	@include('partials.social-share', [
		'text' => '<b>Share Our Game:</b> ',
		'iconSize' => 'sm'
	])
</div>
<script>
	BootstrapDialog.show({
		title: "Thanks for Playing!",
		type: BootstrapDialog.TYPE_DEFAULT,
		size: BootstrapDialog.SIZE_SMALL,
		message: $('#TypeformFinishPopup'),
		nl2br: false,
		cssClass: 'thanks-dialog',
		buttons: [],
		autodestroy: false
	});
</script>