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
      <a href="{{route('ticketform')}}" class="brand-link"  id="logo-link">
        <!--begin::Brand Image-->
        <img
        src="{{ $organizationLogo }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow rounded-circle"
      />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Users</span>
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
            <a href="{{ route('ticketform') }}" class="nav-link {{ Request::routeIs('ticketform') ? 'active' : '' }}">
              <i class="nav-icon bi bi-ui-radios"></i>
              <p>Raise a Ticket</p>
          </a>
          </li>
    

          <li class="nav-item">
            <a href="{{ route('customer.tickets') }}"  class="nav-link {{ Request::routeIs('customer.tickets') ? 'active' : '' }}">
              <i class="nav-icon bi bi-activity"></i>
              <p>
                Ticket History
              </p>
            </a>
          </li>
        </ul>
        <!--end::Sidebar Menu-->
        <!-- Sidebar container -->
      </nav>
      <div class="sidebar">
        <!-- Contact Form -->
              <div id="contactForm" class="contact-form">
                  <textarea id="contactMessage" class="form-control" rows="3" placeholder="Enter Queries"></textarea>
                  <button id="sendButton" class="btn btn-primary btn-sm">Send</button>
              </div>
        <!-- Sidebar Contact Section -->
            <div class="sidebar-contact d-none">
                  <p class="fw-light mb-1 text-nowrap text-truncate">Contact team</p>
                  <h5 class="m-0 lh-1 text-nowrap text-truncate">Queries?</h5>
                  <i class="ri-message-2-fill"></i>
              </div>
          </div>
          <div id="customAlert" class="custom-alert">
            <div class="custom-alert-content">
              <p>Your Query has been sent successfully!</p>
              <button id="closeAlert" class="btn btn-primary btn-sm">OK</button>
            </div>
          </div>
    </div>
    <!--end::Sidebar Wrapper-->
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