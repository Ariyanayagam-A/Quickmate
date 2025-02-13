<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap Gallery - Support Desk Admin Template</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
       
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
                    <img src="{{ asset('assets/images/logo-qickmate.png')}}" class="logo" alt="Bootstrap Gallery" />
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
                  <form id="logout-form" action="{{ route('customer.logout')}}" method="POST" style="display: none;">
                    @csrf    
                    </form>
                  <div class="dropdown ms-2">
                    <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="d-none d-md-block">{{ auth()->user()->name }} </span>
                      <img src="{{ asset('assets/images/user3.png') }}" class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3">
                      <a class="dropdown-item d-flex py-2" href="agent-profile.html">User Profile</a>
                      <a class="dropdown-item d-flex py-2" href="account-settings.html">Account
                        Settings</a>
                        <a href="#" class="dropdown-item d-flex py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
           
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
                
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active-link" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" >
                    Tickets
                  </a>
                  <ul class="dropdown-menu">
                   
                    <li>
                      <a class="dropdown-item" href="open-tickets.html"><span>All Tickets</span></a>
                    </li>
                  
                  </ul>
                </li>

               <!-- Assign model -->
               <div class="modal modal-lg" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Modal Heading</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                      <h2 class="text-center mb-4">Assign Task</h2>
                      
                      <div class="form-group mb-3">
                        <label for="agent" class="form-label">  Assign Agent</label>
                        <select id="agent" name="agent" class="form-select">
                          <option value="0">--Select Agent ---</option>
                          <option value="3">Sabari</option>
                          <option value="4">Karthikeyan</option>
                        </select>
                      </div>
                      
                      <div class="form-group mb-3">
                        <label for="priority" class="form-label">Assign Priority</label>
                        <select id="priority" name="priority" class="form-select" required>
                          <option value="0">--Select Priority ---</option>
                          <option value="1">L1</option>
                          <option value="2">L2</option>
                          <option value="3">L3</option>
                        </select>
                      </div>
                      
                      <div class="d-flex justify-content-center">
                        <button id="submitBtn" class="btn btn-primary btn-sm">Submit</button>
                      </div>
                    </div>

                    <input type="hidden" name="ticketid" id="ticketid" value="">
                    <input type="hidden" name="is_edit" id="is_edit" value="0">
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Close</button>
                    </div>

                  </div>
                </div>
              </div>
               <!-- Assign model -->

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
                <!-- <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item">
                    <i class="icon-home lh-1"></i>
                    <a href="index.html" class="text-decoration-none">Home</a>
                  </li>
                  <li class="breadcrumb-item">Tickets</li>
                  <li class="breadcrumb-item text-light">Open Tickets</li>
                </ol> -->

                <ol class="breadcrumb mb-3">
                 
                  <li class="breadcrumb-item ">
                
                    Tickets
                  </li>
                  <li class="breadcrumb-item text-light">
                    <i class="fa-solid fa-greater-than"></i>
                    Open Tickets</li>
                </ol>
                <!-- Breadcrumb end -->

              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
              <div class="col-12">
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered table-striped align-middle m-0 tickets">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th></th>
                            <th>Request by</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Agent</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Last Message</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>          
                        </tbody>
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
        ajax: "{{ route('supporttickets.list') }}",
        initComplete: function () {
          console.log('initComplete');
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data : 'view', name: 'view'},
            {data : 'request_by', name: 'request_by'},
            {data: 'email', name: 'email'},
            {data: 'subject', name: 'subject'},
            {data: 'agent', name: 'agent'},
            {data: 'country', name: 'country'},
            {data: 'status', name: 'status'},
            {data:'priority', name:'priority'},
            {data: 'last_message', name: 'last_message'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  

        $('.close').click(function(){
          $('#myModal').hide();
        })

        $('#submitBtn').click(function(){
          var agent = $('#agent').val();
          var priority = $('#priority').val();

          var data = {
            agent: agent,
            priority: priority,
            ticketid : $('#ticketid').val()
          }

          console.log('data', data);

          if ((agent === "" || agent ==0 )|| (  priority === "" || priority ==0)) {
            alert('Please select both an agent and a priority.');
            return; // Stop further execution
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          commonAjax(data);
        })

        

      });

      function AssignAgent(id){
        $('#submitBtn').text('Submit');
        $('#myModal').show();
        $('#ticketid').val(id);
        $('#is_edit').val(0);
        console.log('ticketid', id);
        }

        function editTicketAssignment(object,id){
          console.log('object',$(object).attr('data-agent'));
        
          $(`#agent option[value=${$(object).attr('data-agent')}]`).prop('selected', true);
          $(`#priority option[value=${$(object).attr('data-priority')}]`).prop('selected', true);
          $('#ticketid').val(id);
          $('#is_edit').val(1);
          $('#submitBtn').text('Update');
          $('#myModal').show();
        }
        

        function commonAjax(payload)
        {
          $.ajax({
            url: "{{ route('supporttickets.assign') }}",
            type: 'POST',
            data: JSON.stringify(payload), 
            contentType: 'application/json',
            success: function(response){
              console.log('response : ',response);
              if(response.status == 'success')
              {
                if($('#is_edit').val() == 1){
                  alert('Ticket Updated successfully');
                }
                else
                {
                  alert('Ticket Assigned successfully');
                }
                $('#myModal').hide();
                setTimeout(()=> $('#table').DataTable().ajax.reload(),1000);
              }
              else{
                alert('Something went wrong');
              }

            },
            error: function(error){
              console.log(error);
            }
          });
        }
        
    </script>
  </body>

</html>