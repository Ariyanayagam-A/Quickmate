<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap & Icons (or other stylesheets) -->
    <head>
<meta name="csrf-token" content="{{ csrf_token() }}">

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
        <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    @stack('styles') <!-- Additional styles -->

    <!-- datatables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/dist/css/jquery.dataTables.min.css')}}" />

    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    

</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary app-loaded sidebar-open">
<div class="app-wrapper">
    <!-- Navigation Bar -->
    @include('layouts.adminpartials.navbar')

    <!-- Sidebar -->
    @include('layouts.adminpartials.sidebar')


    <!-- Main Content -->
    <main class="app-main">
        <div class="">
          @yield('content')
        </div> 
    </main>
          <!-- Footer -->
    @include('layouts.adminpartials.footer')
        
</div>
    <script src="{{ asset('assets/dist/js/adminlte.js') }} "defer></script>
    {{-- @stack('scripts')  --}}
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    const icon = document.querySelector("#toggleIcon");
    const body = document.body; // Select body element

    if (icon) {
        icon.addEventListener("click", function () {
            if (body.classList.contains("sidebar-open")) {
                body.classList.remove("sidebar-open");
                body.classList.add("sidebar-collapse");
            } else {
                body.classList.remove("sidebar-collapse");
                body.classList.add("sidebar-open");
            }
        });
    }
});

    </script>
      <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>

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
</script>

     
</body>
</html>
