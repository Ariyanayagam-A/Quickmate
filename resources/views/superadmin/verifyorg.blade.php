@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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


 label {
   font-size: 18px;
   margin-right: 10px;
 }
 .switch {
   position: relative;
   display: inline-block;
   width: 44px;
   height: 24px;
 }
 .switch input {
   opacity: 0;
   width: 0;
   height: 0;
 }
 .slider {
   position: absolute;
   cursor: pointer;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   background-color: #ccc;
   border-radius: 34px;
   transition: 0.3s;
 }
 .slider:before {
   content: "";
   height: 18px;
   width: 18px;
   border-radius: 50%;
   background-color: white;
   position: absolute;
   top: 3px;
   left: 4px;
   transition: 0.3s;
 }
 input:checked + .slider {
   background-color: #007bff;
 }
 input:checked + .slider:before {
   transform: translateX(18px);
 }
</style>


<div class="app-wrapper ">

    <main class="app-main container">
      <div class="app-content">
        <div class="container-fluid">
          <div class="row g-4">
            <div class="col-12">
              <div class="callout callout-info">
                 Organization Configuration ||
                <a style="text-decoration: none;" target="_blank" rel="noopener noreferrer" class="callout-link">
                Quickmate
                </a>
              </div>
            </div>

            <div class="card card-info card-outline mb-4">
              <div class="card-header">
                <div class="card-title">Configuration Settings</div>
              </div>

              <form id="organizationForm" action="{{route('superadmin.verifyorg.update')}}" method="POST"class="needs-validation" novalidate>
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                  <!--begin::Row-->
                  <div class="row g-3">
                    <!--begin::Col-->

                    <div class="col-md-6">
                      <label for="validationCustom04" class="form-label">Select Organization</label>
                      <select class="form-select" name="organization_id" id="organization_id" required>
                      <option value="0"> Select Organization</option>
                  @foreach($organizations as $org)
                    <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
                  @endforeach
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label>Enable Authorization </label>
                      <label class="switch">
                        <input type="checkbox" class="toggleOption" id="toggleSwitchEnable"  name="secretEnabled" value="1">
                        <span class="slider"></span>
                      </label>

                      <label>Enable Secret </label>
                      <label class="switch">
                        <input type="checkbox" class="toggleOption" name="secretEnabled" value="1">
                        <span class="slider"></span>
                      </label>
                    </div>

                    <div class="col-md-12">
                      <label>Enable Roles :  </label>
                      <label class="switch">
                        <input type="checkbox" class="toggleOptionRole" name="secretEnabled" id="role" required value="1">
                        <span class="slider"></span>
                      </label>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-12">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          value=""
                          id="invalidCheck"
                          required
                        />
                        <label class="form-check-label" for="invalidCheck">
                          Agree and Continue
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <!--end::Col-->
                  </div>
                  <!--end::Row-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer">
                  <button class="btn btn-info" type="submit">Confirm</button>
                </div>
                <!--end::Footer-->
              </form>

              <script>
                (() => {
                  'use strict';
                  const forms = document.querySelectorAll('.needs-validation');

                  Array.from(forms).forEach((form) => {
                    form.addEventListener('submit', (event) => {
                      if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
                })();
              </script>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
crossorigin="anonymous"
></script>
<script>
  $(document).ready(function() {
    $('.toggleOption').change(function() {

        var organizationId = $('#organization_id').val();

        if(organizationId == 0)
        {
          alert('Please select the organization!!');
          return true;
        }

        var isChecked = $(this).prop('checked');

        $.ajax({
            url: "{{ route('toggle.organization') }}", // Route for toggling
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                status: isChecked,
                organizationId : organizationId
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
              toastr.error(xhr.responseJSON.error);
                alert(xhr.responseJSON.error || "An error occurred.");
            }
        });
    });

    $('.toggleOptionRole').change(function(){

      var organizationId = $('#organization_id').val();

        if(organizationId == 0)
        {
          alert('Please select the organization!!');
          return true;
        }

      $.ajax({
            url: "{{ route('toggle.roleEnable') }}", // Route for toggling
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                organizationId : organizationId
            },
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
              toastr.error(xhr.responseJSON.error);
                alert(xhr.responseJSON.error || "An error occurred.");
            }
        });
    })
});

</script>
        </div>
      </div>
    </div>
  </div>
</main>

</div>
@endsection
