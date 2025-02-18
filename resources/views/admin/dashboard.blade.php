<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard </title>
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

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css')}}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->


<style>
   #lticketsPriorityData {
        width: 100%;
        height: 220px;
    }
    #avgTimeData {
        width: 100%;
        height: 220px;
    }
</style>
 
<!-- chart line -->




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
              <a class="nav-link" href="{{ route('admin.configurations') }}">
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
                  src="{{  asset('assets/dist/assets/img/user2-160x160.jpg') }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <!-- <span class="d-none d-md-inline">Alexander Pierce</span> -->
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="{{ asset('assets/dist/assets/img/user2-160x160.jpg')}}"
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
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{  asset('assets/dist/assets/img/AdminLTELogo.png') }}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item ">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Home
                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-activity"></i>
                  <p>
                    Activities
                  </p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-activity"></i>
                  <p>
                    Activities
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('admin.tickets') }}" class="nav-link">
                      <i class="nav-icon bi bi-ticket-perforated"></i>
                      <p>All My Activities</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./my-group-pending-activities/all-ticket.html" class="nav-link">
                      <i class="nav-icon bi bi-ticket-perforated"></i>
                      <p>My Group Pending Activities</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./My-Pending-Activities/all-ticket.html" class="nav-link">
                      <i class="nav-icon bi bi-ticket-perforated"></i>
                      <p>My Pending Activities</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="./My-Pending-&-Group-Unsigned/all-ticket.html" class="nav-link">
                      <i class="nav-icon bi bi-ticket-perforated"></i>
                      <p>My Pencing & Group Unsigned</p>
                    </a>
                  </li>
                 
                </ul>
              </li>

              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-ticket-detailed"></i>
                  <p>
                    Requests
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-bug"></i>
                  <p>
                    Problems
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-arrow-left-right"></i>
                  <p>
                    Changes
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-pencil-square"></i>
                  <p>
                    Projects
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-rocket-takeoff"></i>
                  <p>
                    Releases
                  </p>
                </a>
              </li> 
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-book"></i>
                  <p>
                    Solutions
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-box"></i>
                  <p>
                    assets
                  </p>
                </a>
              </li> 
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-database"></i>
                  <p>
                    CMDB
                  </p>
                </a>
              </li> 
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-currency-dollar"></i>
                  <p>
                    purchases
                  </p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-flag"></i>
                  <p>
                    Reports
                  </p>
                </a>
              </li>
              


         
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-three-dots"></i>
                  <p>
                    More
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="nav-icon bi bi-clipboard2-check"></i>
                      <p>Contract</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="nav-icon bi bi-wrench"></i>
                      <p>Maintenance</p>
                    </a>
                  </li>
                </ul>
              </li>

            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Helpdesk Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">Requests Last week</h3>
                      <a
                        href="javascript:void(0);"
                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        >View Report</a
                      >
                    </div>
                  </div>
                  <div class="card-body">
             
                    <div class="position-relative mb-4"><div id="visitors-chart"></div></div>
                    <div class="d-flex flex-row justify-content-end">
                      <span class="me-2">
                        <i class="bi bi-square-fill text-primary"></i> Inbound
                      </span>
                      <span> <i class="bi bi-square-fill text-secondary"></i> Complete </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Open Requests by Mode</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i> </a>
                      <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a>
                    </div>
                  </div>
                  

                   <div id="lticketsPriorityData"></div>
                   <div class="d-flex justify-content-center gap-4 my-4">
                    <div class="d-flex align-items-center">
                      High
                      <span class="badge rounded-pill ms-2" style="background-color: #E87609;">15</span>
                    </div>
                    <div class="d-flex align-items-center">
                      Medium
                      <span class="badge rounded-pill bg-dark ms-2">18</span>
                    </div>
                    <div class="d-flex align-items-center">
                      Low
                      <span class="badge rounded-pill bg-secondary ms-2">21</span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col-md-6 -->
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                      <h3 class="card-title">SLA Violation by Technician</h3>
                      <a
                        href="javascript:void(0);"
                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        >View Report</a
                      >
                    </div>
                  </div>
                  <div class="card-body">
                
                    <div class="position-relative mb-4"><div id="sales-chart"></div></div>
                    <div class="d-flex flex-row justify-content-end">
                      <span class="me-2">
                        <i class="bi bi-square-fill text-primary"></i> This year
                      </span>
                      <span> <i class="bi bi-square-fill text-secondary"></i> Last year </span>
                    </div>
                  </div>
                </div>
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Request Complete in Last Week</h3>
                    <div class="card-tools">
                      <a href="#" class="btn btn-sm btn-tool"> <i class="bi bi-download"></i> </a>
                      <a href="#" class="btn btn-sm btn-tool"> <i class="bi bi-list"></i> </a>
                    </div>
                  </div>
                  <div id="avgTimeData"></div>
                </div>
              </div>
              <!-- /.col-md-6 -->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <strong>
          Copyright &copy; 2024-2025&nbsp;
          <a href="www.azeusbros.com" class="text-decoration-none">Azeus Bros</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>


    <script src="{{ asset('assets/dist/js/ticketsPriorityData.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/dist/js/avgTimeData.js') }}"></script>


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
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
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
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <script>

      const visitors_chart_options = {
        series: [
          {
            name: 'High - 2023',
            data: [100, 120, 170, 167, 180, 177, 160],
          },
          {
            name: 'Low - 2023',
            data: [60, 80, 70, 67, 80, 77, 100],
          },
        ],
        chart: {
          height: 200,
          type: 'line',
          toolbar: {
            show: false,
          },
        },
        colors: ['#0d6efd', '#adb5bd'],
        stroke: {
          curve: 'smooth',
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5,
          },
        },
        legend: {
          show: false,
        },
        markers: {
          size: 1,
        },
        xaxis: {
          categories: ['22th', '23th', '24th', '25th', '26th', '27th', '28th'],
        },
      };

      const visitors_chart = new ApexCharts(
        document.querySelector('#visitors-chart'),
        visitors_chart_options,
      );
      visitors_chart.render();

      const sales_chart_options = {
        series: [
          {
            name: 'Net Profit',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
          },
          {
            name: 'Revenue',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94],
          },
          {
            name: 'Free Cash Flow',
            data: [35, 41, 36, 26, 45, 48, 52, 53, 41],
          },
        ],
        chart: {
          type: 'bar',
          height: 200,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997', '#ffc107'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent'],
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return '$ ' + val + ' thousands';
            },
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#sales-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
     <script id="rendered-js">
      Highcharts.chart('containerchart', {
        xAxis: {
          type: 'datetime',
          dateTimeLabelFormats: {
            week: '%e of %b' } },
      
      
      
        series: [{
          data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4, 330, 222, 338, 42, 33, 48, 193, 282, 118],
          pointStart: Date.UTC(2019, 0, 7),
          pointInterval: 24 * 3600 * 1000 * 7 // one week
        }] });
      //# sourceURL=pen.js
          </script>

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>

