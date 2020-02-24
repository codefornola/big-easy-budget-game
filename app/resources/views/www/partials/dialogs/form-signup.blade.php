<div class="modal fade app-modal-signup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title text-center" id="gridModalLabel"><img src="/assets/www/img/logo.png" style="max-width:150px;" alt="Login to Your Account"></h4>
		</div>

        <div class="modal-body">
			<form id="SignupForm" class="form-signup" action="/action/sign-up" method="post">

			    <?=csrf_field();?>

			    <div class="subhead clearfix">
					Where would you like to see the People's Budget?
				</div>
			    <div class="row clearfix">
				    <div class="col-sm-6">
		                <input name="location" type="text" class="form-control" id="InputLocation" placeholder="Location">
				    </div>
				    <div class="col-sm-6">
		                <input name="annual_budget" type="text" class="form-control" id="InputAnnualBudget" placeholder="Annual Budget (If known)">
				    </div>
				</div>

				<div class="subhead">
					Who should we contact for more details?
				</div>
			    <div class="row clearfix">
				    <div class="col-sm-12">
			            <input name="name" type="text" class="form-control" id="InputNameNew" placeholder="Full Name">
				    </div>
			        <div class="col-sm-6">
		                <input name="email" type="email" class="form-control" id="InputEmailNew" placeholder="Email Address">
			        </div>
			        <div class="col-sm-6">
		                <input name="phone" type="text" class="form-control" id="InputPhoneNew" placeholder="Phone Number">
				    </div>
				</div>

				<div class="text-center m-t-md">
					<button type="button" class="btn btn-primary btn-pill js-form-signup-submit">SIGN UP FOR EARLY ACCESS <span class="icon icon-chevron-right"></span></button>
				</div>

			</form>

			<div class="modal-footer hidden" style="text-align: center">
	            <button type="button" class="btn btn-default btn-pill m-t-md" data-dismiss="modal">Okay, I'm finished</button>
	            <button type="button" class="btn btn-primary-outline m-t-md btn-pill js-form-signup-reset">I have another location</button>
	        </div>

        </div>

    </div>
  </div>
</div>