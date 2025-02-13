<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Tickets </title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- datatables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

  </head>

  <body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- App container starts -->
      <div class="app-container">

        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">

          <!-- Container starts -->
          <div class="container">

            <!-- Row starts -->
            <div class="row">
              <div class="col-md-3 col-2">

                <!-- App brand starts -->
                <div class="app-brand">
                  <a href="index.html" class="d-lg-block d-none">
                    <img src="{{ asset('assets/images/logo-qickmate.png')}}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                  <a href="index.html" class="d-lg-none d-md-block">
                    <img src="{{ asset('assets/images/logo-qickmate.png') }}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                </div>
                <!-- App brand ends -->

              </div>

              <div class="col-md-9 col-10">
                <!-- App header actions start -->
                <div class="header-actions d-flex align-items-center justify-content-end">

                  <!-- Search container start -->
                  <!-- <div class="search-container d-none d-lg-block">
                    <input type="text" class="form-control" placeholder="Search" />
                    <i class="icon-search"></i>
                  </div> -->
                  <!-- Search container end -->

                  <!-- <div class="dropdown">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="assets/images/flags/1x1/br.svg" class="flag-img" alt="Brazil" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm dropdown-menu-mini">
                      <div class="country-container">
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/us.svg" alt="USA" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/in.svg" alt="India" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/tr.svg" alt="Turkey" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/gb.svg" alt="Great Britain" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/id.svg" alt="Indonesia" />
                        </a>
                      </div>
                    </div>
                  </div> -->
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-regular fa-envelope"></i>
                      <span class="count rounded-circle bg-danger">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Messages</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-danger rounded-circle me-3">
                            MS
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Moory Sammy</h6>
                            <p class="mb-1">Sent a mail.</p>
                            <p class="small m-0 opacity-50">3 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-primary rounded-circle me-3">
                            KY
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Kyle Yomaha</h6>
                            <p class="mb-1">Need support.</p>
                            <p class="small m-0 opacity-50">5 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-success rounded-circle me-3">
                            SB
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Srinu Basava</h6>
                            <p class="mb-1">Purchased a NotePad.</p>
                            <p class="small m-0 opacity-50">7 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-regular fa-message"></i>
                      <span class="count rounded-circle bg-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Notifications</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user.png" class="img-3x me-3 rounded-3" alt="Admin Themes" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Membership has been ended.</p>
                            <p class="small m-0 opacity-50">Today, 07:30pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Congratulate, James for new job.</p>
                            <p class="small m-0 opacity-50">Today, 08:00pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">
                              Lewis added new schedule release.
                            </p>
                            <p class="small m-0 opacity-50">Today, 09:30pm</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown ms-2">
                    <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="d-none d-md-block">{{ auth()->user()->name}}</span>
                      <img src="{{ asset('assets/images/user3.png')}}" class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout')}}" method="POST" style="display: none;">
                    @csrf    
                    </form>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3">
                      <a class="dropdown-item d-flex align-items-center py-2" href="agent-profile.html">User Profile</a>
                      <a class="dropdown-item d-flex align-items-center py-2" href="account-settings.html">
                          Account
                        Settings</a>
                        <a href="#" class="dropdown-item d-flex align-items-center py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      
                    </div>
                  </div>

                  <!-- Toggle Menu starts -->
                  <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                    <i class="icon-menu"></i>
                  </button>
                  <!-- Toggle Menu ends -->

                </div>
                <!-- App header actions end -->

              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App header ends -->

        <!-- App navbar starts -->
        <nav class="navbar navbar-expand-lg p-0">
          <div class="container">
            <div class="offcanvas offcanvas-end" id="MobileMenu">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title semibold">Navigation</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                  <i class="icon-clear"></i>
                </button>
              </div>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             
                
          
                <li class="nav-item active-link">
                  <a class="nav-link" href="agents.html"> Tickets </a>
                </li>
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Login
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="login.html">
                        <span>Login</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="signup.html">
                        <span>Signup</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="reset-password.html">
                        <span>Reset Password</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="forgot-password.html">
                        <span>Forgot Password</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="page-not-found.html">
                        <span>Page Not Found</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="maintenance.html">
                        <span>Maintenance</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- App Navbar ends -->

        <!-- App body starts -->
        <div class="app-body">

          <!-- Container starts -->
          <div class="container">

            <!-- Row start -->
            <div class="row">
              <div class="col-12 col-xl-6">

                <!-- Breadcrumb start -->
                <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item">
                    <i class="fa-solid fa-house"></i>
                    <a href="agents.html" class="text-decoration-none">Home</a>
                  </li>
                  <li class="breadcrumb-item text-light">
                    <i class="fa-solid fa-greater-than"></i>
                    User</li>
                </ol>

                

                <!-- Breadcrumb end -->

              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
              <div class="col-12 col-xl-2">
                      <div>
                        <a href="{{ route('ticketform') }}" >
                            <button type="button" class="btn btn-secondary" fdprocessedid="im3l2s">
                              New Ticket
                            </button>
                          </a>
                      </div>
              </div>
              <div class="col-12">
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped align-middle m-0 tickets">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Ticket.no</th>
                            <th>Title</th>
                            <th>Created On</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Updated On</th>
                            <th>level</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody></tbody>

                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App body ends -->

        <!-- App footer start -->
        <div class="app-footer">
          <div class="container">
            <span>© Azeusbros</span>
          </div>
        </div>
        <!-- App footer end -->

      </div>
      <!-- App container ends -->

    </div>
    <!-- Page wrapper end -->

    <!-- Custom JS files -->
    <script type="text/javascript">
        $(function() {
            console.log($('.tickets')); // Ensure it logs the table element

        var table = $('.tickets').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tickets.list') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data : 'ticket_no', name: 'ticket_no'},
            {data: 'title', name: 'title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'category', name: 'category'},
            {data: 'description', name: 'description'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'level', name: 'level'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  
        });
    </script>
  </body>

</html>