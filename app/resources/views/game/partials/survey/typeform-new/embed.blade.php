<style>
	#typeform-full{
		position: absolute;
		left:0;
		right:0;
		bottom:0;
		top:0;
		border:0;
	}
</style>
<div id="typeform-full"></div>

<script src="https://embed.typeform.com/embed.js" type="text/javascript"></script>
<script type="text/javascript">
    window.addEventListener("DOMContentLoaded", function() {
      var el = document.getElementById("typeform-full");
      
      // When instantiating a widget embed, you must provide the DOM element
      // that will contain your typeform, the URL of your typeform, and your
      // desired embed settings
      window.typeformEmbed.makeWidget(el, "https://{!! $surveyAccount !!}.typeform.com/to/{!! $surveyId !!}", {
        hideFooter: true,
        hideHeaders: true,
        opacity: 0
      });
    });
  </script>