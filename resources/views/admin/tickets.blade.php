<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | my-activites | All Ticket</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Admin | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="Admin is a Free Bootstrap 5 Admin Dashboard"
    />
    <meta
      name="keywords"
      content="bootstrap 5"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- <link rel="stylesheet" href="./dist/css/tickets/main.min.css" /> -->
    <!-- <link rel="stylesheet" href="./dist/css/tickets/OverlayScrollbars.min.css" /> -->
    <!-- <link rel="stylesheet" href="./dist/css/main.min.css"> -->

<!-- chart line -->

<style>
  main{
    overflow-x: hidden !important;
  }
  .table-striped tbody tr td{
    text-align: center;
  }
  .table-striped thead tr th{
    text-align: center;
  }
</style>

    <!-- datatables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  </head>
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link" style="font-weight: 700;">Dashboard</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Schedular</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Tech Availability Chart</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Tasks</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Remainders</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Announcements</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            
            <li class="nav-item ">
              <a class="nav-link" href="../setup.html">
                <i class="bi bi-gear"></i>
              </a>
          
            </li>
            <!--end::Messages Dropdown Menu-->
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell"></i>
                <span class="navbar-badge badge text-bg-warning">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0);" id="fullscreenToggle">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" id="maximizeIcon"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" id="minimizeIcon" style="display: none;"></i>
              </a>
            </li>
            
            
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="{{ asset('assets/dist/assets/img/user2-160x160.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <!-- <span class="d-none d-md-inline">Alexander Pierce</span> -->
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ asset('assets/dist/assets/img/user2-160x160.jpg') }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce
                    <small>Alex@gmail.com</small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                <li class="user-body">
                  <!--begin::Row-->
                  <div class="row">
                    <div class="col-4 text-center"><a href="#">Account</a></div>
                    <!-- <div class="col-4 text-center"><a href="#">Sales</a></div> -->
                    <div class="col-4 text-center"><a href="#">Personalize</a></div>
                  </div>
                  <!--end::Row-->
                </li>
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <!-- <a href="#" class="btn btn-default btn-flat"></a> -->
                  <a href="#" class="btn btn-default btn-flat ">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
     
      <!--end::Sidebar-->
      <!--begin::App Main-->
    <main class="app-main">

       <!-- Row start -->
       <div class="dropdown m-3">
        <button class="btn btn-drp dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Tickets
        </button>
        <ul class="dropdown-menu dropdown-menu-dark-bg">
          <li><a class="dropdown-item active drp-clr" href="./all-ticket.html">All-Tickets</a></li>
          <li><a class="dropdown-item drp-clr" href="./canceled-ticket.html">canceled</a></li>
          <li><a class="dropdown-item drp-clr" href="./solved-ticket.html">Solved</a></li>
          <li><a class="dropdown-item drp-clr" href="./inprogress-ticket.html">Inprogress</a></li>
          <li><a class="dropdown-item drp-clr" href="./onhold-ticket.html">On-Hold</a></li>

          <!-- <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Separated link</a></li> -->
        </ul>
      </div>

       <div class="row">
        <div class="col-12 col-xl-6">

          <!-- Breadcrumb start -->
         

          <ol class="breadcrumb m-3">
            <li class="breadcrumb-item ">
              Activities
            </li>
            <li class="breadcrumb-item ">
              All My Activities
            </li>
            <li class="breadcrumb-item ">
              All Ticket
            </li>
          </ol>
          <!-- Breadcrumb end -->

        </div>
      </div>
      <input type="text" id="searchBox" onkeyup="searchTable()" class="form-control mb-3" placeholder="Search ..">

       <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="table ticketstable table-bordered table-striped align-middle m-0">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Ticket ID</th>
                      <th>Requested by</th>
                      <th>Email</th>
                      <th>Subject</th>
                      <th>Category </th>
                      <th>Engineer</th>
                      <th>Indicator</th>
                      <th>Level</th>
                      <th>Status</th>
                      <th>Created At</th>
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
    

    </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <!-- <div class="float-end d-none d-sm-inline">Anything you want</div> -->
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2024-2025&nbsp;
          <a href="www.azeusbros.com" class="text-decoration-none">Azeus Bros</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

  


    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <script>
   $(function() {

      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });

        console.log($('.tickets')); // Ensure it logs the table element

        var table = $('.ticketstable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tickets.adminlist') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data : 'ticket_no', name: 'ticket_no'},
            {data : 'requested_by', name: 'requested_by'},
            {data : 'email', name: 'email'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'assigned_to', name: 'assigned_to'},
            {data: 'indicator', name: 'indicator'},
            {data: 'level', name: 'level'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            
            // {data: 'description', name: 'description'},
            // {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  

    });
    
    </script>
  </body>
</html>