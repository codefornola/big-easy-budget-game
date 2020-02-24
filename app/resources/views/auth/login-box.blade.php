<form id="AuthForm" class="auth hidden" action="/auth/login" method="post">
    {{ csrf_field() }}
	<div class="third-parties login-extra">
		<span class="subhead">Super simple login with:</span>
	    <a href="/facebook/authorize" class="btn btn-link btn-social btn-social-facebook">
	        <span class="fa-stack fa-lg">
	            <i class="fa fa-circle fa-stack-2x"></i>
	            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
	        </span>
	        <span class="social-title">Facebook</span>
	    </a>
		{{--<a href="/twitter/authorize" class="btn btn-link btn-social">--}}
		{{--<span class="fa-stack fa-lg">--}}
		{{--<i class="fa fa-circle fa-stack-2x"></i>--}}
		{{--<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>--}}
		{{--</span>--}}
		{{--<span class="social-title">Twitter</span>--}}
		{{--</a>--}}
		<a href="/google/authorize" class="btn btn-link btn-social btn-social-google">
	        <span class="fa-stack fa-lg">
	            <i class="fa fa-circle fa-stack-2x"></i>
	            <i class="fa fa-google fa-stack-1x fa-inverse"></i>
	        </span>
	        <span class="social-title">Google</span>
	    </a>
	    <a href="#" class="btn btn-link btn-social btn-social-email">
	        <span class="fa-stack fa-lg">
	            <i class="fa fa-circle fa-stack-2x"></i>
	            <i class="fa fa-user fa-stack-1x fa-inverse"></i>
	        </span>
	        <span class="social-title">Email</span>
	    </a>
	    {{--<div class="divider">--}}
	        {{--or--}}
	    {{--</div>--}}
	</div>
    <div class="auth-inputs hidden">
		<div class="subhead register-extra hidden">
			It's easy to register and play!
		</div>
		<div class="subhead email-extra hidden">
			Don't have an account? <a href="#" class="auth-register-btn">Register here</a>
		</div>
        <div class="auth-register email-extra"></div>
	    <div class="form-group register-extra hidden">
            <input name="name" type="text" class="form-control" id="InputName" placeholder="Full name">
		</div>
        <div class="form-group">
            <input name="email" type="email" class="form-control" id="InputEmail" placeholder="Email">
		</div>
		<div class="form-group">
            <input name="password" type="password" class="form-control" id="InputPwd" placeholder="Password">
	        <p class="help-block register-extra hidden">Password must be at least 6 characters.</p>
		</div>
        <div class="form-group register-extra hidden">
            <input name="password_confirmation" type="password" class="form-control" id="InputPwdConfirm" placeholder="Confirm Password">
		</div>
		<button type="submit" class="btn btn-block btn-default">Login</button>
    </div>
    <div class="auth-login register-extra hidden">Already signed up? <a href="#" class="auth-login-btn">Login here</a></div>
    <div class="auth-register email-extra hidden">Prefer to use Social Login? <a href="#" class="auth-login-btn">Go back</a></div>
</form>