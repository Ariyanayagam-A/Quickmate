@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

@if(session('import_errors'))
    <div class="alert alert-danger">
        <ul>
            @foreach(session('import_errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


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
  .footer-org{
    display: flex;
    justify-content: center;
  }
  .eye-icon{
  position: absolute;
      right: 10px;
      top: 75%;
      transform: translateY(-50%);
      cursor: pointer;
      left: 95%;
  }
  .password-container {
      position: relative;
    }

  </style>
  {{-- <h2>User Registration</h2>
  <form action="{{ route('user.create') }}" method="POST">
      @csrf
      <label for="username">Username:</label>
      <input type="text" name="username" required><br><br>

      <label for="fname">Firstname :</label>
      <input type="text" name="fname" required><br><br>

      <label for="lname">Lastname :</label>
      <input type="text" name="lname" required><br><br>

      <label for="email">Email:</label>
      <input type="text" name="email" required><br><br>

      <label for="password">Password:</label>
      <input type="password" name="password" required><br><br>

      <!-- <label for="role">Role:</label>
      <select name="role" required>
          <option value="user">User</option>
          <option value="support team">Support Team</option>
          <option value="engineer">Engineer</option>
      </select><br><br> -->

      <button type="submit">Register</button>
  </form> --}}

  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row g-4">
        <!--begin::Col-->
        <div class="col-12">
          <div class="callout callout-info">
             User details ||
            <a
            style="text-decoration: none;"
              target="_blank"
              rel="noopener noreferrer"
              class="callout-link"
            >
            Quickmate
            </a>
          </div>
        </div>



          <!--begin::Form Validation-->
          <div class="card card-info card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Upload Users</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('user.create') }}"  method="POST" id="organizationForm" class="needs-validation" novalidate>
                @csrf
              <!--begin::Body-->
              <div class="card-body">
                <!--begin::Row-->
                <div class="row g-3">
                  <!--begin::Col-->
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">First Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="User-Name"
                      value=""
                      required
                      name="fname"                    />
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="User-Name"
                      value=""
                      required
                      name="lname"
                    />
                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">User Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="User-Name"
                      value=""
                      required
                      name="username"                    />

                  </div>
                  <div class="col-md-6">
                    <label for="validationCustom01" class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="Email"
                      value=""
                      required
                      name="email"
                      />
                      @error('email')
                      <span class="text-danger">{{ $message }}</span>
                  @enderror
                  </div>
                  <div class="col-md-6 password-container">
                    <label for="validationCustom01" class="form-label">Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="Password"
                      value=""
                      required
                      name="password"
                    />
                    <i class="bi bi-eye-slash eye-icon" id="togglePassword"></i>
                  </div>
                  <div class="col-md-6 d-none" >
                    <label for="validationCustom04" class="form-label">Upload File</label>
                  <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02" />
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                  </div>
                  </div>

                  <!--end::Col-->
                  <!--begin::Col-->
                 
                  <!--end::Col-->
                </div>
                <!--end::Row-->
              </div>
              <!--end::Body-->
              <!--begin::Footer-->
              <div class="card-footer">
                <input type="submit" class="btn btn-info" type="submit">
              </div>
              <!--end::Footer-->
            </form>
            <!--end::Form-->
            <!--begin::JavaScript-->
            <!-- Enter User Using Exel file -->
          <div class="card-body">
              <!--begin::Row-->
              <div class="row g-9">
                <!--begin::Col-->
                <div class="col-md-6">
                  <form action="{{route('import-excel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="validationCustom01" class="form-label">Upload Users Using Excel File</label>
            
                    <!-- Form elements in a row -->
                    <div class="d-flex align-items-center gap-2">
                      <input
                        type="file"
                        class="form-control"
                        id="User-Name"
                        required
                        name="file" />
                      
                      <button type="submit" class="btn btn-info">Upload</button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
            
                <!--end::Col-->
             
            <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (() => {
                'use strict';

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation');

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                  form.addEventListener(
                    'submit',
                    (event) => {
                      if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                      }

                      form.classList.add('was-validated');
                    },
                    false,
                  );
                });
              })();
            </script>
            <!--end::JavaScript-->
          </div>
          <!--end::Form Validation-->

        <!--end::Col-->
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>


<script>
    const passwordInput = document.getElementById('Password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
    });
</script>

@endsection
