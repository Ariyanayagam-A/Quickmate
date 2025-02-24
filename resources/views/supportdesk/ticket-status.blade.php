<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard | All Ticket</title>
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
  /* Sidebar container styling */
.sidebar {
  position: relative;
  width: 100%;
  top: 70%;
  /* background-color: #f8f9fa; */
}

/* Hidden contact form initially */
.contact-form {
  position: absolute;
  top: -150px; /* Hidden above the sidebar */
  left: 0;
  right: 0;
  background-color: #ffffff;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  display: none;
  z-index: 1000;
  animation: slideDown 0.3s ease-in-out;
}

/* Textarea styling */
.contact-form textarea {
  width: 100%;
  resize: none;
  margin-bottom: 10px;
}

/* Button styling */
.contact-form button {
  display: inline-block;
  width: 100%;
}

/* Animation for sliding down */
@keyframes slideDown {
  from {
    transform: translateY(-20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Custom alert modal styling */
.custom-alert {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

.custom-alert-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.custom-alert-content button {
  margin-top: 10px;
}
.sidebar-contact {
  padding: 10px 15px 10px 50px;
  background: #238781;
  color: #fff;
  margin: 18px 20px 8px 20px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  position: relative;
  cursor: pointer;
}
</style>

<!-- datatables -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
<!-- datatables -->

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
            
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
           
            <!--end::Navbar Search-->
            <!--begin::Messages Dropdown Menu-->
            
           
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
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
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
                  <a href="./login.html" class="btn btn-default btn-flat ">Sign out</a>
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
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('assets//dist/assets/img/AdminLTELogo.png') }}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Support Desk</span>
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
           
              <!-- <li class="nav-item ">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-activity"></i>
                  <p>
                    Activities
                  </p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('supporttickets.view') }}" class="nav-link ">
                  <i class="nav-icon bi bi-ticket-perforated"></i>
                  <p>
                    New Tickets
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('supportticketsstatus.view') }}" class="nav-link active">
                  <i class="nav-icon bi-ticket-perforated-fill"></i>
                  <p>
                    Ticket Status
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('supportticketshistory.view') }}" class="nav-link">
                  <i class="nav-icon bi bi-activity"></i>
                  <p>
                    Tickets History
                  </p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
            <!-- Sidebar container -->
          </nav>
          
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
    <main class="app-main">

       <!-- Row start -->

    
<div class="m-3">
  <input type="text" id="searchBox" onkeyup="searchTable()" class="form-control mb-3" placeholder="Search ..">

</div>

       <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="ticketStatus table table-bordered table-striped align-middle m-0">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Ticket.no</th>
                      <th>Created On</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Engineer</th>
                      <th>Indicator</th>
                      <th>Status</th>
                      <th>level</th>
                      <th>Closed At</th>
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
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./dist/js/adminlte.js"></script>
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
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
 
   

    <!--end::Script-->
  </body>
  <!--end::Body-->
  <script>
    function searchTable() {
        let input = document.getElementById("searchBox").value.toLowerCase();
        let table = document.getElementById("dataTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            let cells = rows[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none"; // Show/hide rows based on search
        }
    }
</script>
<script>
$(function(){
  // 
  document.addEventListener("DOMContentLoaded", function () {
    const sidebarContact = document.querySelector(".sidebar-contact");
    const contactForm = document.getElementById("contactForm");
    const sendButton = document.getElementById("sendButton");
    const customAlert = document.getElementById("customAlert");
    const closeAlert = document.getElementById("closeAlert");
  
    sidebarContact.addEventListener("click", function () {
      // Toggle visibility of the contact form
      if (contactForm.style.display === "none" || contactForm.style.display === "") {
        contactForm.style.display = "block";
      } else {
        contactForm.style.display = "none";
      }
    });
  
    sendButton.addEventListener("click", function () {
      const message = document.getElementById("contactMessage").value.trim();
      if (message) {
        // Show the custom alert
        customAlert.style.display = "flex";
  
        // Clear the message box
        document.getElementById("contactMessage").value = "";
  
        // Hide the form
        contactForm.style.display = "none";
      } else {
        alert("Please enter a message before sending.");
      }
    });
  
    closeAlert.addEventListener("click", function () {
      // Hide the custom alert
      customAlert.style.display = "none";
    });
  });

  $('.ticketStatus').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('supporttickets.assignticket') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        {data: 'ticket_no', name: 'ticket_no'},
        {data: 'created_at', name: 'created_at'},
        {data: 'category', name: 'category'},
        {data: 'description', name: 'description'},
        {data: 'engineer', name: 'engineer'},
        {data: 'indicator', name: 'indicator'},
        {data: 'status', name: 'status'},
        {data: 'level', name: 'level'},
        {data: 'closed_at', name: 'closed_at'},
    ]
  });

})
      </script>
</html>
