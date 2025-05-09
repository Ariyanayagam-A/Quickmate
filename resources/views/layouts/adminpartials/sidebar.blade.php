@php
      $organization = Session::get('organization');
      $logoPath = isset($organization['logo']) ? $organization['logo'] : null;

    if ($logoPath) {
        $folder = dirname($logoPath); // logos
        $filename = basename($logoPath); // 1744008302_cloud .png
        $encodedFile = rawurlencode($filename); // encodes space as %20
        // $organizationLogo = asset("public/storage/{$folder}/{$encodedFile}"); //for ubundu
        $organizationLogo = asset("storage/{$folder}/{$encodedFile}");

    } else {
        $organizationLogo = asset('assets/dist/assets/img/AdminLTELogo.png');
    }
    // dd($organizationLogo);
@endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{ route('admin.dashboard') }}" class="brand-link" id="logo-link">
        <!--begin::Brand Image-->
        <img
        src="{{ $organizationLogo }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow rounded-circle"
        id="logo-img"
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
            <a href="{{ route('admin.dashboard') }}"  class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
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
            <a href="{{ route('admin.tickets') }}" class="nav-link {{ Request::routeIs('admin.tickets') ? 'active' : '' }}">
              <i class="nav-icon bi bi-ticket-perforated"></i>
              <p>All My Activities</p>
            </a>

          </li>
            
              <li class="nav-item">
                <a href="{{route('admin.manageuser')}}"class="nav-link {{ Request::routeIs('admin.manageuser') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-people"></i>
                  <p>Manage Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('import-user')}}" class="nav-link {{ Request::routeIs('import-user') ? 'active' : '' }}">
                  <i class="nav-icon bi bi-person-add"></i>
                  <p>Add Users</p>
                </a>
              </li>


              
             
              <li class="nav-item">
                <a href="{{route('admin.categories')}}" class="nav-link {{ Request::routeIs('admin.categories') ? 'active' : ''}}">
                  <i class="nav-icon bi bi-plus-circle"></i>
                  <p>Add Category</p>
                </a>
              </li>

          <li class="nav-item ">
            <a href="{{ route('admin.reports') }}" class="nav-link {{ Request::routeIs('admin.reports') ? 'active' : ''}}">
              <i class="nav-icon bi bi-flag"></i>
              <p>
                Reports
              </p>
            </a></li> 

          <li class="nav-item ">
            <a href="{{ route('admin.siem') }}" class="nav-link {{ Request::routeIs('admin.siem') ? 'active' : ''}}">
              <i class="nav-icon bi bi-shield-lock"></i>
              <p>
                SIEM
              </p>
            </a></li> 

          <li class="nav-item ">
            <a href="{{ route('admin.assets') }}" class="nav-link {{ Request::routeIs('admin.assets') ? 'active' : ''}}">
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
  <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
  
        <!-- Image in its own centered block -->
        <div class="pt-3">
          <img src="{{ asset('assets/dist/assets/img/azeuslogo.png') }}" alt="Icon" width="280">
        </div>
  
        <!-- Close button floated to top right -->
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
  
        {{-- <!-- Title -->
        <div class="modal-header border-0 justify-content-center">
          <h5 class="modal-title" id="logoModalLabel">Secret Modal</h5>
        </div> --}}
  
        <!-- Body -->
        <div class="modal-body">
          <p>Engineering Tomorrow’s Software, Today.</p>
          <p>Smart Code. Bold Solutions. Powered by Azeus Bros.</p>
        </div>
  
        <!-- Footer -->
        <div class="modal-footer justify-content-center border-0">
          <a href="https://www.azeusbros.com/" target="_blank" class="btn" style="background-color: gold; color: black;">
            Visit Azeus Bros
          </a>
                </div>
  
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let clickCount = 0;
      const logoLink = document.getElementById('logo-link');
      const logoModal = new bootstrap.Modal(document.getElementById('logoModal'));
  
      logoLink.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent navigating right away
        clickCount++;
  
        if (clickCount === 5) {
          logoModal.show();
          clickCount = 0;
        }
  
        // Optional: reset the count if no clicks for 3 seconds
        clearTimeout(window.clickResetTimer);
        window.clickResetTimer = setTimeout(() => {
          clickCount = 0;
        }, 3000);
      });
    });
  </script>
 
  
