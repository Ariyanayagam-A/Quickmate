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
            <a href="{{ route('admin.dashboard') }}" class="nav-link ">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Home
                <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
              </p>
            </a>
          </li>
         

          <li class="nav-item">
            {{-- <a href="#" class="nav-link">
              <i class="nav-icon bi bi-activity"></i>
              <p>
                Activities
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a> --}}
            <a href="{{ route('admin.tickets') }}" class="nav-link ">
              <i class="nav-icon bi bi-ticket-perforated"></i>
              <p>All My Activities</p>
            </a>

          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-three-dots"></i>
              <p>
                User Groups
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.manageuser')}}" class="nav-link">
                  <i class="nav-icon bi bi-clipboard2-check"></i>
                  <p>Manage Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('import-user')}}" class="nav-link">
                  <i class="nav-icon bi bi-clipboard2-check"></i>
                  <p>Add Users</p>
                </a>
              </li>


              
             
              <li class="nav-item">
                <a href="{{route('admin.categories')}}" class="nav-link {{ Request::routeIs('admin.categories') ? 'active' : ''}}">
                  <i class="nav-icon bi bi-wrench"></i>
                  <p>Add Category</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item ">
            <a href="{{ route('admin.siem') }}" class="nav-link">
              <i class="nav-icon bi bi-people"></i>
              <p>
                SIEM
              </p>
            </a>


          <li class="nav-item ">
            <a href="{{ route('admin.assets') }}" class="nav-link">
              <i class="nav-icon bi bi-box"></i>
              <p>
                Assets
              </p>
            </a>
          </li> 

          


     
        

      </ul>
  
      </nav>
    </div>

  </aside>

