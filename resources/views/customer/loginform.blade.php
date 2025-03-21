<!doctype html>
<html lang="en">
  <head>
    <title>{{  env('APP_NAME') }} | Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
     
	{{-- <link rel="stylesheet" href="style.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets/dist/css/loginform.css') }}" />
	</head>
	<body class="img js-fullheight" style="background-image: url({{ asset('assets/dist/assets/img/bg.jpg') }}); overflow-y: hidden;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Quickmate Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<!-- <h3 class="mb-4 text-center"></h3> -->
		      	<form action="{{ route('customer.login') }}" method="POST" class="signin-form">
              @csrf
              @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
		      		<div class="form-group">
                {{-- <input type="text" name="name_email" required class="form-control" placeholder="Enter your email" /> --}}
		      			<input type="text"  name="name_email" required class="form-control" placeholder="Enter your email" required>
		      		</div>
	            <div class="form-group">
                {{-- <input type="password" name="password" required class="form-control" placeholder="Enter password" /> --}}
	              <input id="password-field" name="password" required type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
							
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
	          <div class="social d-flex text-center">
              
 {{-- <a href="{{ route('azure.login') }}" class="btn btn-warning">
  <i class="bi bi-microsoft me-2"></i> Sign in using Microsoft
</a> --}}

	          	<a href="{{ route('azure.login') }}" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-microsoft mr-2"></span>Microsoft</a>
	          	
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    (function($) {

"use strict";

var fullHeight = function() {

    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
        $('.js-fullheight').css('height', $(window).height());
    });

};
fullHeight();

$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

})(jQuery);

</script>
</body>
</html>

