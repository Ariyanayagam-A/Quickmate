<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{ route('super.admin.dashboard') }}" class="brand-link">
        <!--begin::Brand Image-->
        <img
        src="{{  asset('assets/dist/assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Super Admin</span>
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
            <a href="{{ route('super.admin.dashboard') }}" class="nav-link ">

              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Home
                <!-- <i class="nav-arrow bi bi-chevron-right"></i> -->
              </p>
            </a>
          </li>
         

 
            <li class="nav-item ">
              <a href="#" class="nav-link">
                <i class="bi bi-person nav-icon "></i>
                <p>
                  Organisation Details
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('super.admin.org') }}" class="nav-link">
                    <i class="nav-icon bi bi-clipboard2-check"></i>
                    <p>New Organisation</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('super.admin.lisense') }}" class="nav-link">
                    <i class="nav-icon bi  bi-clipboard2-check"></i>
                    <p>Lisenced Organisation</p>
                  </a>
                </li>
              </ul>
            </li>

      

          <li class="nav-item ">
            <a href="{{ route('super.admin.siem') }}" class="nav-link">
              <i class="nav-icon bi bi-bug"></i>
              <p>
                SIEM
              </p>
            </a>
          </li>
          <li class="nav-item ">
           
          <li class="nav-item ">
            <a href="{{ route('super.admin.assets') }}" class="nav-link">
              <i class="nav-icon bi bi-arrow-left-right"></i>
              <p>
                Assets
              </p>
            </a>
          </li>
       
          


     
         

      </ul>
  
      </nav>
    </div>

  </aside>

