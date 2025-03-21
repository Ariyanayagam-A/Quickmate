<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="{{route('ticketform')}}" class="brand-link">
        <!--begin::Brand Image-->
        <img
        src="{{  asset('assets/dist/assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
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
            <a href="{{ route('ticketform') }}" class="nav-link">
              <i class="nav-icon bi bi-ui-radios"></i>
              <p>Raise a Ticket</p>
          </a>
          </li>
    

          <li class="nav-item">
            <a href="{{ route('customer.tickets') }}"  class="nav-link ">
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