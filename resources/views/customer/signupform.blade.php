<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title> Qicktick</title>

		<!-- Meta -->
		<meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="{{ asset('assets/images/logo-qickmate.png') }}"/>

		<!-- *************
			************ CSS Files *************
		************* -->
		<!-- Icomoon Font Icons css -->
		<link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

	</head>

	<body class="bg-one">
		<!-- Container start -->
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-4 col-lg-5 col-sm-6 col-12">
					<form action="{{ route('customer.store') }}" method="POST" class="my-5">
                        @csrf
						<div class="card p-md-4 p-sm-3">
							<div class="login-form">
								<a href="index.html" class="mb-4 d-flex">
									<img src="{{ asset('assets/images/logo-qickmate.png') }}" class="img-fluid login-logo" alt="Bootstrap Gallery" />
								</a>
								<h2 class="mt-4 mb-4">Signup</h2>
                                <div class="mb-3">
									<label class="form-label">Name</label>
									<input type="text" name="name" required class="form-control" placeholder="Enter your Name" />
								</div>
								<div class="mb-3">
									<label class="form-label">Email</label>
									<input type="text" name="email" required class="form-control" placeholder="Enter your email" />
								</div>
								<div class="mb-3">
									<label class="form-label">Password</label>
									<div class="input-group">
										<input type="password" name="password" required class="form-control" placeholder="Enter password" />
										<a href="#" class="input-group-text">
											<i class="icon-eye"></i>
										</a>
									</div>
								</div>
								<div class="d-flex align-items-center justify-content-between">
									<div class="form-check m-0">
										<input class="form-check-input" type="checkbox" value="" id="termsConditions" />
										<label class="form-check-label" for="termsConditions">I agree to the terms and conditions</label>
									</div>
								</div>
								<div class="d-grid py-3 mt-3">
									<button type="submit" class="btn btn-lg btn-success">
										SIGNUP
									</button>
								</div>
								<div class="text-center py-2">or Signup with</div>
								<div class="btn-group w-100">
									<button type="button" class="btn btn-sm btn-outline-light">
										Google
									</button>
									<button type="button" class="btn btn-sm btn-outline-light">
										Facebook
									</button>
									<button type="button" class="btn btn-sm btn-outline-light">
										Twitter
									</button>
								</div>
								<div class="text-center pt-4">
									<span>Already have an account?</span>
									<a href="{{ route('customer.login')}}" class="text-success text-decoration-underline">
										Login</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Container end -->
	</body>

</html>