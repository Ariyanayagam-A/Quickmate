<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap & Icons (or other stylesheets) -->
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Bootstrap Gallery - Support Desk Admin Template</title>
  
      <!-- Meta -->
      <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
      <meta name="author" content="Bootstrap Gallery" />
      <link rel="canonical" href="https://www.bootstrap.gallery/">
      <meta property="og:url" content="https://www.bootstrap.gallery">
      <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
      <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
      <meta property="og:type" content="Website">
      <meta property="og:site_name" content="Bootstrap Gallery">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg')}}" />
  
      <!-- *************
        ************ CSS Files *************
      ************* -->
      <!-- Icomoon Font Icons css -->
      <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />
  
      <!-- Main CSS -->
      {{-- <link rel="stylesheet" href="{{ asset('assets/css/main.min.css')}}" /> --}}
      <link rel="stylesheet" href="{{ asset('assets/dist/js/adminlte.js')}}" />
      <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.css')}}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
      <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"/>
      <!-- *************
        ************ Vendor Css Files *************
      ************ -->
  
      <!-- Scrollbar CSS -->
      {{-- <link rel="stylesheet" href="assets/vendor/overlay-scroll/OverlayScrollbars.min.css" /> --}}
      <link rel="stylesheet" href="{{ asset('assets/dist/css/jquery.dataTables.min.css')}}" />
      <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
         
    </head>
<style>
  main{
    overflow-x: hidden !important;
  }
  .table-striped tbody tr td{
    text-align: center;
  }
  .table-striped thead tr th{
    text-align: center;
  }
  /* Sidebar container styling */
.sidebar {
  position: relative;
  width: 100%;
  top: 70%;
  /* background-color: #f8f9fa; */
}

/* Hidden contact form initially */
.contact-form {
  position: absolute;
  top: -150px; /* Hidden above the sidebar */
  left: 0;
  right: 0;
  background-color: #ffffff;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 15px;
  display: none;
  z-index: 1000;
  animation: slideDown 0.3s ease-in-out;
}

/* Textarea styling */
.contact-form textarea {
  width: 100%;
  resize: none;
  margin-bottom: 10px;
}

/* Button styling */
.contact-form button {
  display: inline-block;
  width: 100%;
}

/* Animation for sliding down */
@keyframes slideDown {
  from {
    transform: translateY(-20px);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

/* Custom alert modal styling */
.custom-alert {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

.custom-alert-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.custom-alert-content button {
  margin-top: 10px;
}
.sidebar-contact {
  padding: 10px 15px 10px 50px;
  background: #238781;
  color: #fff;
  margin: 18px 20px 8px 20px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  position: relative;
  cursor: pointer;
}

table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

</style>



<body class="layout-fixed sidebar-expand-lg bg-body-tertiary app-loaded sidebar-open">    
  <div class="app-wrapper">
    <!-- Navigation Bar -->
    @include('layouts.supportteampartials.nav')

    <!-- Sidebar -->
    @include('layouts.supportteampartials.sidebar')

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
    @include('layouts.supportteampartials.footer')
    </div>

  



    @stack('scripts') <!-- Additional scripts -->
    </div>
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

</body>
</html>
