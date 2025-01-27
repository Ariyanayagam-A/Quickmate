<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin <?=
   isset($activeLink) && !empty($activeLink) ? ucfirst($activeLink) : ''?> </title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <!-- <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery"> -->
    <!-- <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards"> -->
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}" />
  </head>

  <body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- App container starts -->
      <div class="app-container">

        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">

          <!-- Container starts -->
          <div class="container">

            <!-- Row starts -->
            <div class="row">
              <div class="col-md-3 col-2">

                <!-- App brand starts -->
                <div class="app-brand">
                  <a href="index.html" class="d-lg-block d-none">
                    <img src="{{ asset('assets/images/logo-qickmate.png') }}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                  <a href="index.html" class="d-lg-none d-md-block">
                    <img src="{{ asset('assets/images/logo-qickmate.png') }}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                </div>
                <!-- App brand ends -->

              </div>

              <div class="col-md-9 col-10">
                <!-- App header actions start -->
                <div class="header-actions d-flex align-items-center justify-content-end">

                  <!-- Search container start -->
                  <!-- <div class="search-container d-none d-lg-block">
                    <input type="text" class="form-control" placeholder="Search" />
                    <i class="icon-search"></i>
                  </div> -->
                  <!-- Search container end -->

                  <!-- <div class="dropdown">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="assets/images/flags/1x1/br.svg" class="flag-img" alt="Brazil" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm dropdown-menu-mini">
                      <div class="country-container">
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/us.svg" alt="USA" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/in.svg" alt="India" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/tr.svg" alt="Turkey" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/gb.svg" alt="Great Britain" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/id.svg" alt="Indonesia" />
                        </a>
                      </div>
                    </div>
                  </div> -->
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <!-- <i class="icon-mail fs-4 lh-1"></i> -->
                      <i class="fa-regular fa-envelope"></i>
                      <span class="count rounded-circle bg-danger">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Messages</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-danger rounded-circle me-3">
                            MS
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Moory Sammy</h6>
                            <p class="mb-1">Sent a mail.</p>
                            <p class="small m-0 opacity-50">3 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-primary rounded-circle me-3">
                            KY
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Kyle Yomaha</h6>
                            <p class="mb-1">Need support.</p>
                            <p class="small m-0 opacity-50">5 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-success rounded-circle me-3">
                            SB
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Srinu Basava</h6>
                            <p class="mb-1">Purchased a NotePad.</p>
                            <p class="small m-0 opacity-50">7 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <!-- <i class="icon-twitch fs-4 lh-1"></i> -->
                      <i class="fa-regular fa-message"></i>
                      <span class="count rounded-circle bg-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Notifications</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="{{ asset('assets/images/user.png') }}" class="img-3x me-3 rounded-3" alt="Admin Themes" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Membership has been ended.</p>
                            <p class="small m-0 opacity-50">Today, 07:30pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="{{ asset('assets/images/user2.png') }}" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Congratulate, James for new job.</p>
                            <p class="small m-0 opacity-50">Today, 08:00pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="{{ asset('assets/images/user1.png') }}" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">
                              Lewis added new schedule release.
                            </p>
                            <p class="small m-0 opacity-50">Today, 09:30pm</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown ms-2">
                    <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="d-none d-md-block">Admin</span>
                      <img src="{{ asset('assets/images/user3.png') }}" class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3">
                      <a class="dropdown-item d-flex align-items-center py-2" href="agent-profile.html"><i
                          class="icon-smile fs-4 me-3"></i>User Profile</a>
                      <a class="dropdown-item d-flex align-items-center py-2" href="account-settings.html"><i
                          class="icon-settings fs-4 me-3"></i>Account
                        Settings</a>
                      <a class="dropdown-item d-flex align-items-center py-2" href="login.html"><i
                          class="icon-log-out fs-4 me-3"></i>Logout</a>
                    </div>
                  </div>

                  <!-- Toggle Menu starts -->
                  <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                    <i class="icon-menu"></i>
                  </button>
                  <!-- Toggle Menu ends -->

                </div>
                <!-- App header actions end -->

              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App header ends -->
        @include('admin.layouts.navbar')
        <!-- App body starts -->
        <div class="app-body">

          <!-- Container starts -->
          <div class="container">

            <!-- Row start -->
            <div class="row">
              <div class="col-12 col-xl-6">

                <!-- Breadcrumb start -->
                <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item ">
                    <i class=" fa-solid fa-house">
                    </i>
                    <a href="index.html" class="text-decoration-none">Home</a>
                  </li>
                  <li class="breadcrumb-item ">
                    <i class="fa-solid fa-greater-than"></i>
                    Dashboards
                  </li>
                  <li class="breadcrumb-item text-light">
                    <i class="fa-solid fa-greater-than"></i>
                    Analytics</li>
                </ol>
                <!-- Breadcrumb end -->

              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-2">
              <div class="col-xl-6 col-12">
                <!-- Row start -->
                <div class="row gx-2">
                  <div class="col-12">
                    <div class="card mb-2">
                      <div class="card-header">
                        <h5 class="card-title">Tickets</h5>
                      </div>
                      <div class="card-body">
                        <div id="ticketsData"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12">
                    <div class="card mb-2">
                      <div class="card-header">
                        <h5 class="card-title">Today's Tickets</h5>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                          <span>Completed</span>
                          <span class="fw-bold">75%</span>
                        </div>
                        <div class="progress small">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-12">
                    <div class="card mb-2">
                      <div class="card-header">
                        <h5 class="card-title">New Tickets</h5>
                      </div>
                      <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                          <span>Assigned</span>
                          <span class="fw-bold">5</span>
                        </div>
                        <div class="progress small">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Row end -->
              </div>
              <div class="col-xl-6 col-12">
                <div class="row gx-2">
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape1.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-book-open"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">27</h3>
                        <h6 class="m-0 fw-light text-light">Active</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape2.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-check-circle"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">18</h3>
                        <h6 class="m-0 fw-light text-light">Solved</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape3.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-x-circle"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">12</h3>
                        <h6 class="m-0 fw-light text-light">Closed</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape4.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-add_task"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">3</h3>
                        <h6 class="m-0 fw-light text-light">Open</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape5.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-alert-triangle"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">5</h3>
                        <h6 class="m-0 fw-light text-light">Critical</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4 col-6">
                    <div class="card px-3 py-2 mb-2 d-flex flex-row align-items-center">
                      <div class="position-relative shape-block">
                        <img src="{{ asset('assets/images/shape6.png') }}" class="img-fluid img-4x" alt="Bootstrap Themes" />
                        <i class="icon-access_time"></i>
                      </div>
                      <div class="ms-2">
                        <h3 class="m-0 fw-semibold">7</h3>
                        <h6 class="m-0 fw-light text-light">High</h6>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="card mb-2">
                      <div class="card-header">
                        <h5 class="card-title">Avg. Response Time</h5>
                      </div>
                      <div class="card-body">
                        <div id="avgTimeData"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-2">
              <div class="col-xl-4 col-md-6 col-sm-12 col-12">


                <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Tickets by Priority</h5>
                  </div>
                  <div class="card-body">
                    <div id="lticketsPriorityData"></div>

                    <div class="d-flex justify-content-center gap-4 my-4">
                      <div class="d-flex align-items-center">
                        High
                        <span class="badge rounded-pill bg-primary ms-2">15</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Medium
                        <span class="badge rounded-pill bg-secondary ms-2">18</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Low
                        <span class="badge rounded-pill bg-dark ms-2">13</span>
                      </div>
                    </div>
                  </div>
                </div>





                <!-- <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Live Calls</h5>
                  </div>
                  <div class="card-body">
                    <div id="liveCallsData"></div>

                    <div class="d-flex justify-content-center gap-4 my-4">
                      <div class="d-flex align-items-center">
                        <i class="icon-phone-incoming me-3"></i> Incoming
                        <span class="badge rounded-pill bg-primary ms-2">15</span>
                      </div>
                      <div class="d-flex align-items-center">
                        <i class="icon-phone-outgoing me-3"></i> Outgoing
                        <span class="badge rounded-pill bg-secondary ms-2">18</span>
                      </div>
                    </div>
                  </div>
                </div> -->












              </div>
              <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Agents Online</h5>
                  </div>
                  <div class="card-body">
                    <div id="agentsLiveData"></div>

                    <div class="d-flex justify-content-center gap-4 my-4">
                      <div class="d-flex align-items-center">
                        Busy
                        <span class="badge rounded-pill bg-primary ms-2">15</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Online
                        <span class="badge rounded-pill bg-secondary ms-2">18</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Offline
                        <span class="badge rounded-pill bg-dark ms-2">13</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-sm-12 col-12">




                <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">New & Closed</h5>
                  </div>
                  <div class="card-body">
                    <div id="newClosedGraph"></div>
                  </div>
                </div>






                <!-- <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Live Calls</h5>
                  </div>
                  <div class="card-body">
                    <div id="liveCallsData"></div>

                    <div class="d-flex justify-content-center gap-4 my-4">
                      <div class="d-flex align-items-center">
                        <i class="icon-phone-incoming me-3"></i> Incoming
                        <span class="badge rounded-pill bg-primary ms-2">15</span>
                      </div>
                      <div class="d-flex align-items-center">
                        <i class="icon-phone-outgoing me-3"></i> Outgoing
                        <span class="badge rounded-pill bg-secondary ms-2">18</span>
                      </div>
                    </div>
                  </div>
                </div> -->

<!-- 

                <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Tickets by Priority</h5>
                  </div>
                  <div class="card-body">
                    <div id="lticketsPriorityData"></div>

                    <div class="d-flex justify-content-center gap-4 my-4">
                      <div class="d-flex align-items-center">
                        High
                        <span class="badge rounded-pill bg-primary ms-2">15</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Medium
                        <span class="badge rounded-pill bg-secondary ms-2">18</span>
                      </div>
                      <div class="d-flex align-items-center">
                        Low
                        <span class="badge rounded-pill bg-dark ms-2">13</span>
                      </div>
                    </div>
                  </div>
                </div> -->









                
              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row gx-2">
              <div class="col-xl-6 col-lg-12 col-12">
                <!-- <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Top 5 Agents</h5>
                  </div>
                  <div class="card-body">
                    <div class="border rounded-3">
                      <div class="table-responsive">
                        <table class="table align-middle custom-table m-0">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Agent</th>
                              <th>Tickets</th>
                              <th>Time Spent</th>
                              <th>Feedback</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>
                                <div class="fw-semibold">Elisa Shah</div>
                              </td>
                              <td>
                                <span class="badge bg-primary">54</span>
                              </td>
                              <td>
                                <span class="badge border border-light">2 Hrs 30 Mins</span>
                              </td>
                              <td>
                                <div class="starReadOnly1 rating-stars my-2"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>
                                <div class="fw-semibold">Ladonna Jones</div>
                              </td>
                              <td>
                                <span class="badge bg-primary">49</span>
                              </td>
                              <td>
                                <span class="badge border border-light">2 Hrs 21 Mins</span>
                              </td>
                              <td>
                                <div class="starReadOnly2 rating-stars my-2"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>
                                <div class="fw-semibold">Jewel Alexander</div>
                              </td>
                              <td>
                                <span class="badge bg-primary">45</span>
                              </td>
                              <td>
                                <span class="badge border border-light">2 Hrs 15 Mins</span>
                              </td>
                              <td>
                                <div class="starReadOnly1 rating-stars my-2"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>
                                <div class="fw-semibold">Rich Spears</div>
                              </td>
                              <td>
                                <span class="badge bg-primary">42</span>
                              </td>
                              <td>
                                <span class="badge border border-light">2 Hrs 10 Mins</span>
                              </td>
                              <td>
                                <div class="starReadOnly1 rating-stars my-2"></div>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>
                                <div class="fw-semibold">Shelly Daniel</div>
                              </td>
                              <td>
                                <span class="badge bg-primary">38</span>
                              </td>
                              <td>
                                <span class="badge border border-light">2Hrs 05Mins</span>
                              </td>
                              <td>
                                <div class="starReadOnly1 rating-stars my-2"></div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="col-xl-3 col-lg-6 col-12">
                <!-- <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">Feedback</h5>
                  </div>
                  <div class="card-body">
                    <div class="scroll300">
                      <div class="my-2">
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Christian Ochoa</h5>
                            <p class="mb-1">Amazing</p>
                            <p class="m-0 text-light">3 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Marci Aguirre</h5>
                            <p class="mb-1">
                              Great as always. All sorted with in a short time.
                            </p>
                            <p class="m-0 text-light">5 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Rico Barry</h5>
                            <p class="mb-1">All sorted with in a short time.</p>
                            <p class="m-0 text-light">5 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Dawn Shepherd</h5>
                            <p class="mb-1">Great support guys</p>
                            <p class="m-0 text-light">6 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-danger rounded-5">
                            <i class="icon-thumbs-down"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Heidi Ali</h5>
                            <p class="mb-1">Sorry guys</p>
                            <p class="m-0 text-light">6 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Julio Olson</h5>
                            <p class="mb-1">Awesome support</p>
                            <p class="m-0 text-light">9 mins ago</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-start">
                          <div class="media-box me-3 bg-primary rounded-5">
                            <i class="icon-thumbs-up"></i>
                          </div>
                          <div class="mb-4">
                            <h5>Lily Lyons</h5>
                            <p class="mb-1">Thanks</p>
                            <p class="m-0 text-light">9 mins ago</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="col-xl-3 col-lg-6 col-12">
                <!-- <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="card-title">New & Closed</h5>
                  </div>
                  <div class="card-body">
                    <div id="newClosedGraph"></div>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- Row end -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App body ends -->

        <!-- App footer start -->
        <div class="app-footer">
          <div class="container">
            <span>© Azeusbros</span>
          </div>
        </div>
        <!-- App footer end -->

      </div>
      <!-- App container ends -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
			************ JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

    <!-- *************
			************ Vendor Js Files *************
		************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>


    <!-- Apex Charts -->
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/ticketsData.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/avgTimeData.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/liveCallsData.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/agentsLiveData.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/ticketsPriorityData.js')}}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/home/newClosedData.js')}}"></script>

    <!-- Rating -->
    <script src="{{ asset('assets/vendor/rating/raty.js')}}"></script>


  </body>

</html>