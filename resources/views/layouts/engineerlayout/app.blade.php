<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Bootstrap & Icons (or other stylesheets) -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Agent | Dashboard </title>
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
   <!-- DataTables CSS -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}


<!-- DataTables JS -->

    @stack('styles') <!-- Additional styles -->
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
</style>

<body>
    <div class="app-wrapper">
    <!-- Navigation Bar -->
    @include('layouts.engineerpartials.navbar')

    <!-- Sidebar -->
    @include('layouts.engineerpartials.sidebar')

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
    @include('layouts.engineerpartials.footer')
    </div>

  



    @stack('scripts') <!-- Additional scripts -->
    </div>
</body>
</html>
