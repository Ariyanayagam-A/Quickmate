<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="" class="brand-link">
        <!--begin::Brand Image-->
        <img
        src="{{ asset('assets/dist/assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />

        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Engineer Desk</span>
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
        
          <li class="nav-item">
            <a href="{{ route('agenttickets.view') }}" class="nav-link ">
              <i class="nav-icon bi bi-ticket-perforated"></i>
              <p>
                New Tickets
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="{{ route('agentholdedtickets.view') }}" class="nav-link">
              <i class="nav-icon bi-ticket-perforated-fill"></i>
              <p>
                Onhold Tickets
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('agenthistoryestickets.view') }}" class="nav-link ">
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
      <div class="sidebar">
   
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>