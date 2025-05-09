

<!doctype html>
<html lang="en">
  <head>
    <title>{{  env('APP_NAME') }} | Reset Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
     
	{{-- <link rel="stylesheet" href="style.css"> --}}
  <link rel="stylesheet" href="{{ asset('assets/dist/css/loginform.css') }}" />
	</head>
	<body class="img js-fullheight" style="background-image: url({{ asset('assets/dist/assets/img/login-bg.jpg') }}); overflow-y: hidden;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Reset Password</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<!-- <h3 class="mb-4 text-center"></h3> -->
		      	<form method="POST" action="{{ route('password.reset.submit') }}">
              @csrf
               <input type="hidden" name="organization_id" value="{{ $orgId }}">
			  @if (session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
				@endif
              @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @if($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              @endif
			  
              <div class="form-group">
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
                <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Reset Password</button>
	            </div>
	          </form>
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




