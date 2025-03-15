<nav class="app-header navbar navbar-expand bg-body">
  
  @php
      $user = Session::get('user');
      $azureUser = isset($user['username']) ? $user['username']  : 'Admin';
      $azureMail = isset($user['email']) ?  $user['email'] :  'admin@kloudstacks.com';
@endphp
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Start Navbar Links-->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="javascript:void(0);" id="toggleIcon">
          <i class="bi bi-list"></i>
          </a>
        </li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link" style="font-weight: 700;">Dashboard</a></li>
        {{-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Schedular</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Tech Availability Chart</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Tasks</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Remainders</a></li>
        <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Announcements</a></li> --}}
      </ul>
      <!--end::Start Navbar Links-->
      <!--begin::End Navbar Links-->
      <ul class="navbar-nav ms-auto">
        <!--begin::Navbar Search-->
        {{-- <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="bi bi-search"></i>
          </a>
        </li> --}}
        <!--end::Navbar Search-->
        <!--begin::Messages Dropdown Menu-->
        
        {{-- <li class="nav-item ">
          <a class="nav-link" href="../setup.html">
            <i class="bi bi-gear"></i>
          </a>
       --}}
        </li>
        <!--end::Messages Dropdown Menu-->
        <!--begin::Notifications Dropdown Menu-->
        {{-- <li class="nav-item dropdown">
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
        </li> --}}
        <!--end::Notifications Dropdown Menu-->
        <!--begin::Fullscreen Toggle-->
        {{-- <li class="nav-item">
          <a class="nav-link" href="javascript:void(0);" id="fullscreenToggle">
            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen" id="maximizeIcon"></i>
            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" id="minimizeIcon" style="display: none;"></i>
          </a>
        </li> --}}
        
        
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
                 {{ $azureUser }}
                <small> {{ $azureMail }} </small>
              </p>
            </li>
            <!--end::User Image-->
            <!--begin::Menu Body-->
            {{-- <li class="user-body">
              <!--begin::Row-->
              <div class="row">
                <div class="col-4 text-center"><a href="#">Account</a></div>
                <!-- <div class="col-4 text-center"><a href="#">Sales</a></div> -->
                <div class="col-4 text-center"><a href="#">Personalize</a></div>
              </div>
              <!--end::Row-->
            </li> --}}
            <!--end::Menu Body-->
            <!--begin::Menu Footer-->
            <li class="user-footer">
              <!-- <a href="#" class="btn btn-default btn-flat"></a> -->
              <a href="{{ route('customer.loginform')}}" class="btn btn-default btn-flat ">Sign out</a>
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