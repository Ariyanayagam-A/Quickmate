<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap & Icons (or other stylesheets) -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin | Dashboard </title>
        <!--begin::Primary Meta Tags-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="Admin | Dashboard" />
        <meta name="author" content="ColorlibHQ" />
        <meta
          name="description"
          content="Admin is a Free Bootstrap 5 Admin Dashboard"
        />
        <meta
          name="keywords"
          content="bootstrap 5"
        />
    
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
          integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
          crossorigin="anonymous"/>
        <!--end::Third Party Plugin(Bootstrap Icons)-->
        <!--begin::Required Plugin(AdminLTE)-->
        <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css')}}" />
        <!--end::Required Plugin(AdminLTE)-->
        <!-- apexcharts -->
    
    {{-- <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    @stack('styles') <!-- Additional styles -->
</head>
<body>
    <div class="app-wrapper">
    <!-- Navigation Bar -->
    @include('partials.navbar')

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="app-main">
        <div class="">
            <!-- Sidebar Width -->
            <div class="">
                @yield('sidebar') <!-- Optional custom sidebar section -->
            </div>
            <!-- Page Content -->
            <div class="">
                @yield('content')
            </div>
          </main>
          <!-- Footer -->
    @include('partials.footer')
    </div>

  

    <!-- Scripts -->
    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/main.js') }}"></script>

    @stack('scripts') <!-- Additional scripts -->
<script>
    
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });

      document.addEventListener("DOMContentLoaded", function () {
    const sidebarContact = document.querySelector(".sidebar-contact");
    const contactForm = document.getElementById("contactForm");
    const sendButton = document.getElementById("sendButton");
    const customAlert = document.getElementById("customAlert");
    const closeAlert = document.getElementById("closeAlert");
  
    sidebarContact.addEventListener("click", function () {
      // Toggle visibility of the contact form
      if (contactForm.style.display === "none" || contactForm.style.display === "") {
        contactForm.style.display = "block";
      } else {
        contactForm.style.display = "none";
      }
    });
  
    sendButton.addEventListener("click", function () {
      const message = document.getElementById("contactMessage").value.trim();
      if (message) {
        // Show the custom alert
        customAlert.style.display = "flex";
  
        // Clear the message box
        document.getElementById("contactMessage").value = "";
  
        // Hide the form
        contactForm.style.display = "none";
      } else {
        alert("Please enter a message before sending.");
      }
    });
  
    closeAlert.addEventListener("click", function () {
      // Hide the custom alert
      customAlert.style.display = "none";
    });
  });
    </script>



    </div>
</body>
</html>
