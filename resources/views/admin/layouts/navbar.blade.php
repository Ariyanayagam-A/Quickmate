<nav class="navbar navbar-expand-lg p-0">
          <div class="container">
            <div class="offcanvas offcanvas-end" id="MobileMenu">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title semibold">Navigation</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                  <i class="icon-clear"></i>
                </button>
              </div>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown <?= $activeLink == 'dashboard' ? 'active-link' : ''?>">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Dashboards
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item current-page" href="index.html">
                        <span>Analytics</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item <?= $activeLink == 'tickets' ? 'active-link' : ''?>">
                  <a class="nav-link" href="{{ route('admin.tickets') }}"> Tickets </a>
                </li>
                <li class="nav-item <?= $activeLink == 'categories' ? 'active-link' : ''?>">
                  <a class="nav-link" href="{{ route('admin.categories') }}"> Categories </a>
                </li>
                  <!-- <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="all-tickets.html">
                        <span>All Tickets</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="open-tickets.html"><span>Open Tickets</span></a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="pending-tickets.html"><span>Pending Tickets</span></a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="closed-tickets.html"><span>Closed Tickets</span></a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="solved-tickets.html"><span>Solved Tickets</span></a>
                    </li>
                  </ul> -->
                  <li class="nav-item dropdown <?= $activeLink == 'users' ? 'active-link' : ''?>">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Users
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item current-page" href="index.html">
                        <span>Customers</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item current-page" href="index.html">
                        <span>Team Leaders</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item current-page" href="index.html">
                        <span>Agents</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Login
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="login.html">
                        <span>Login</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="signup.html">
                        <span>Signup</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="reset-password.html">
                        <span>Reset Password</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="forgot-password.html">
                        <span>Forgot Password</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="page-not-found.html">
                        <span>Page Not Found</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="maintenance.html">
                        <span>Maintenance</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>