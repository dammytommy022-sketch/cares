@extends('layouts.header')
@section('content')
<div class="row g-0 app-auth-wrapper">
	<div class="col-12 col-md-3"></div>
	<div class="col-12 col-md-6 auth-main-col text-center p-5">
		<div class="d-flex flex-column align-content-end">
			<div class="app-auth-body mx-auto">	
				<div class="app-auth-branding mb-4">
					<a class="app-logo" href="index.html">
						<img class="logo-icon me-2" src="assets/images/tlogo.png" alt="logo">
					</a>
				</div>
				<h2 class="auth-heading text-center mb-5">ADMIN PORTAL</h2>
				<div class="auth-form-container text-start">
					<form action="{{ url('/admin_login') }}" method="POST" class="auth-form login-form">         
						@csrf
						<div class="email mb-3">
							<label class="sr-only" for="signin-email">Email</label>
							<input id="signin-email" name="email" type="email" class="form-control signin-email" placeholder="Email address" required="required">
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div><!--//form-group-->
						<div class="password mb-3">
							<label class="sr-only" for="signin-password">Password</label>
							<input id="signin-password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
							<div class="extra mt-3 row justify-content-between">
								<div class="col-6">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
										<label class="form-check-label" for="RememberPassword">
										Remember me
										</label>
									</div>
								</div><!--//col-6-->
								<div class="col-6">
									<div class="forgot-password text-end">
										<a href="reset-password.html">Forgot password?</a>
									</div>
								</div><!--//col-6-->
							</div><!--//extra-->
						</div><!--//form-group-->
						<div class="text-center">
							<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
						</div>
					</form>
					
					<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div>
				</div><!--//auth-form-container-->	

			</div><!--//auth-body-->
		
			@include('layouts.footer')<!--//app-auth-footer-->	
		</div><!--//flex-column-->   
	</div><!--//auth-main-col-->
	<div class="col-12 col-md-3"></div>
	    
    
</div><!--//row-->
@endsection