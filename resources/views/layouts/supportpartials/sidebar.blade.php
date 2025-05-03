<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="" class="brand-link" id="logo-link">
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

  <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
  
        <!-- Image in its own centered block -->
        <div class="pt-3">
          <img src="{{ asset('assets/dist/assets/img/azeuslogo.png') }}" alt="Icon" width="280" height="110">
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