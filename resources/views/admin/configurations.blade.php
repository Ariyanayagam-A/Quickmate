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
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css')}}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="{{ asset('assets/dist/css/setup.css')}}">
 
<!-- chart line -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/dist/js/setupmain.js') }}"></script>




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
            <li class="nav-item d-none d-md-block"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
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
            <li class="nav-item dropdown gear-icon">
              <a class="nav-link" href="./setup.html">
                <i class="bi bi-gear-fill " ></i>
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
                     Admin
                    <small>admin@yopmail.com</small>
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
              src="{{ asset('assets/dist/assets/img/AdminLTELogo.png') }}"
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
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Home
                    <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
                  </p>
                </a>
              </li>
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
                    <a href="./all-my-activities/all-ticket.html" class="nav-link">
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
      <main class="app-main" style="flex-direction: column !important;">
        <div>
          <div class="search-container">
            <input type="text" id="searchBoxx" class="form-control" placeholder="Search in Setup...">
            <div id="results" class="dropdown-results"></div>
          </div>
        </div>
       
        <div class="container-fluid text-center">
          <!-- <input type="text" id="searchBox" class="form-control w-50 mx-auto m-4" placeholder="Search settings..."> -->
         

          <div class="row">
            <div class="col">
              <div>
              <i class="bi bi-building icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Instance Configuration</a>
              </div>
              <div>
              <a href="./setup/inastance.html">Instance Settings |</a>
              <a href="./setup/region.html">Regions |</a>
              <a href="./setup/sites.html">Sites |</a>
              <a href="./setup/operational-hours.html">Operational Hours |</a>
              <a href="./setup/holiday-groups.html">Holiday Groups |</a>
              <a href="./setup/unavailability-types.html">Unavailability Types |</a>
              <a href="./setup/department.html">Departments |</a>
              <a href="./setup/organization-roles.html">Organization Roles</a>
              </div>
            </div>
            <div class="col ">
              <div>
              <i class="bi bi-person-square icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Users & Permissions</a>
              </div>
              <div>
              <a href="./setup/roles.html">Roles |</a>
              <a href="./setup/users.html">Users |</a>
              <a href="./setup/user-groups.html">User Groups |</a>
              <a href="./setup/technician-groups.html">Technician Groups |</a>
              <a href="./setup/privacy-settings.html">Privacy Settings</a>
              </div>
            </div>
            
            <div class="col ">
              <div>
                <i class="bi bi-envelope-at icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Mail Settings</a>
              </div>
              <div>
              <a href="./setup/mail-server.html">Mail Server Settings |</a>
              <a href="./setup/mailaddress.html">Mail Addresses |</a>
              <a href="./setup/mail-box.html">Mail Box |</a>
              <a href="./setup/mail-filter.html">Mail Filter |</a>
              <a href="./setup/email-command.html">Email Command</a>
              </div>
            </div>
            
    
            <div class="col ">
              <div>
                <i class="bi bi-magic icn-setup"></i>
              </div>
               <div>
                <a href="" style="color: chocolate">Customization</a>
              </div>
              <div>
              <a href="./setup/Helpdesk.html">Helpdesk |</a>
              <a href="./setup/Solution-Management-custom.html">Solution Management |</a>
              <a href="./setup/Additional-Fields.html">Additional Fields |</a>
              <a href="./setup/Checklists-custom.html">Checklists |</a>
              <a href="./setup/Announcement-custom.html">Announcement</a>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid text-center mt-4">
          <!-- <input type="text" id="searchBox" class="form-control w-50 mx-auto m-4" placeholder="Search settings..."> -->

          <div class="row">
            <div class="col">
              <div>
                <i class="bi bi-file-earmark-bar-graph icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Templates & Forms</a>
              </div>
              <div>
              <a href="./setup/Service-Category.html">Service Category |</a>
              <a href="./setup/Incident-Template.html">Incident Template |</a>
              <a href="./setup/Solution-Template.html">Solution Template |</a>
              <a href="./setup/Task-Template-Layout.html">Task Template & Layout |</a>
              <a href="./setup/Reply-Template.html">Reply Template |</a>
              <a href="./setup/Resolution-Template.html">Resolution Template |</a>
              <a href="./setup/Form-Rules.html">Form Rules |</a>
              <a href="./setup/Custom-Scripts.html">Custom Scripts</a>
              </div>
              

            </div>
            <div class="col ">
              <div>
              <i class="bi bi-robot icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Automation</a>
              </div>
              <div>
              <a href="./setup/Business-Rules.html">Business Rules |</a>
              <a href="./setup/Service-Level-Agreements.html">Service Level Agreements |</a>
              <a href="./setup/Life-Cycles.html">Life Cycles |</a>
              <a href="./setup/Triggers.html">Triggers |</a>
              <a href="./setup/Custom-Actions.html">Custom Actions |</a>
              <a href="./setup/Notification-Rules.html">Notification Rules |</a>
              <a href="./setup/Closure-Rules.html">Closure Rules |</a>
              <a href="./setup/Delegation.html">Delegation |</a>
              <a href="./setup/Workflows.html">Workflows</a>

              </div>
              

            </div>
            
            <div class="col ">
              <div>
                <i class="bi bi-file-earmark-richtext icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">User Survey</a>
              </div>
              <div>
              <a href="./setup/Survey-Settings.html">Survey Settings |</a>
              <a href="./setup/Define-Survey.html">Define Survey |</a>
              <a href="./setup/Survey-Preview.html">Survey Preview |</a>
              <a href="./setup/Survey-Results.html">Survey Results</a>
              </div>
            </div>
            
            
            
            <div class="col ">
              <div>
                <i class="bi bi-collection icn-setup"></i>
              </div>
               <div>
                <a href="" style="color: chocolate">Data Administration</a>
              </div>
              <div>
              <a href="./setup/Data-Archive.html">Data Archive |</a>
              <a href="./setup/Audit-Log.html">Audit Log |</a>
              <a href="./setup/System-Log.html">System Log |</a>
              <a href="./setup/PII-ePHI-Log.html">PII/ePHI Log |</a>
              <a href="./setup/Import-Data.html">Import Data |</a>
              <a href="./setup/Export-Data.html">Export Data</a>
              </div>
            </div>

          </div>
        </div>
        <div class="container-fluid text-center mt-4">
          <!-- <input type="text" id="searchBox" class="form-control w-50 mx-auto m-4" placeholder="Search settings..."> -->

          <div class="row">
            <div class="col">
              <div>
                <i class="bi bi-gear icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">General Settings</a>
              </div>
              <div>
              <a href="./setup/Advanced-Portal-Settings.html">Advanced Portal Settings |</a>
              <a href="./setup/Requester-Portal.html">Requester Portal |</a>
              <a href="./setup/Theme-Settings.html">Theme Settings |</a>
              <a href="./setup/Cloud-Attachments.html">Cloud Attachments |</a>
              <a href="./setup/Approval-Settings.html">Approval Settings</a>
              
              </div>
              


            </div>
           
            
            <div class="col ">
              <div>
                <i class="bi bi-puzzle icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Apps & Add-ons</a>
              </div>
              <div>
              <a href="./setup/Chat-Settings.html">Chat Settings |</a>
              <a href="./setup/Analytics-PlusProjects.html">Analytics PlusProjects |</a>
              <a href="./setup/SMS-Settings.html">SMS Settings |</a>
              <a href="./setup/Third-Party-Integrations.html">Third Party Integrations |</a>
              <a href="./setup/Quickmate-Survey.html">Quickmate Survey</a>
              </div>
            </div>
            
            
            <div class="col ">
              <div>
                <i class="bi bi-code-slash icn-setup"></i>
              </div>
               <div>
                <a href="" style="color: chocolate">Developer Space</a>
              </div>
              <div>
              <a href="./setup/Custom-Menu.html">Custom Menu |</a>
              <a href="./setup/Global-Variables.html">Global Variables </a>
              </div>
            </div>
            
            <div class="col ">
              <div>
              <i class="bi bi-chat-quote icn-setup"></i>
              </div>
              <div>
                <a href="" style="color: chocolate">Zia</a>
              </div>
              <div>
              <a href="./setup/Artificial-Intelligence.html">Artificial Intelligence |</a>
              <a href="./setup/Zia-Chatbot.html">Zia Chatbot </a>
              </div>
            </div>

          </div>
        </div>
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
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
 

    <!--end::Script-->
  </body>

  <!--end::Body-->

</html>
