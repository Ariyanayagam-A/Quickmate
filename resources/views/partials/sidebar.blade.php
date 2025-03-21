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
          <!-- <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-activity"></i>
              <p>
                Activities
              </p>
            </a>
          </li> -->

          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-activity"></i>
              <p>
                Activities
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
              <li class="nav-item">
                <a href="{{ route('admin.tickets') }}" class="nav-link">
                  <i class="nav-icon bi bi-ticket-perforated"></i>
                  <p>All My Activities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../my-group-pending-activities/all-ticket.html" class="nav-link">
                  <i class="nav-icon bi bi-ticket-perforated"></i>
                  <p>My Group Pending Activities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../my-group-pending-activities/all-ticket.html" class="nav-link">
                  <i class="nav-icon bi bi-ticket-perforated"></i>
                  <p>My Pending Activities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../My-Pending-&-Group-Unsigned/all-ticket.html" class="nav-link">
                  <i class="nav-icon bi bi-ticket-perforated"></i>
                  <p>My pending & Group Unsigned</p>
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
