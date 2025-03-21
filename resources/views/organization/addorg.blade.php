@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
        <main class="app-main container">
          <!--begin::App Content Header-->
          <div class="app-content-header">
            <!--begin::Container-->
          
            <!--end::Container-->
          </div>
          <!--end::App Content Header-->
          <!--begin::App Content-->
          <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
              <!--begin::Row-->
              <div class="row g-4">
                <!--begin::Col-->
                <div class="col-12">
                  <div class="callout callout-info">
                     Organization Registration Form Fields||
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
                    <div class="card-header"><div class="card-title">Organisational Details</div></div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    @if(session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                    @endif
                    <form action="{{ route('organization.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                      @csrf
                      <!--begin::Body-->
                      <div class="card-body">
                        <!--begin::Row-->
                        <div class="row g-3">
                          <!--begin::Col-->
                          <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Organization Name</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Organization-Name"
                              value=""
                              required
                              name="organization_name"
                            />
                          
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Industry</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Industry"
                              value=""
                              required
                              name="industry"
                            />
                           
                          </div>
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Organization Type</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Industry"
                              value=""
                              placeholder="e.g. IT, Healthcare, Education, Finance, etc."
                              required
                              name="organization_type"
                            />
                           
                          </div>
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Website URL</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Industry"
                              value=""
                              required
                              name="website_url"
                            />
                           
                          </div>
                          <div class="col-md-6">
                            <label for="organization_size" class="form-label">Organization Size</label>
                            <select class="form-select" id="organization_size" name="organization_size" required>
                                <option selected disabled value="">Select</option>
                                <option value="1-10">1-10</option>
                                <option value="11-50">11-50</option>
                                <option value="51-100">51-100</option>
                                <option value="100-200">100-200</option>
                            </select>
                        </div>
                        
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-md-6">
                            <label for="logo" class="form-label">Upload Logo</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="logo" name="logo" />
                                <label class="input-group-text" for="logo">Logo Upload</label>
                            </div>
                        </div>

                          <div class="card-header"><div class="card-title">Organization Contact Information</div></div>
                   
                     

                          <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Official Email</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Official-Email"
                              value=""
                              required
                              name="official_email"
                            />
                          
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Phone Number</label>
                            <input
                              type="number"
                              class="form-control"
                              id="Phone-Number"
                              value=""
                              required
                              name="phone_number"
                            />
                           
                          </div>

                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Address</label>
                            <textarea
                              type="text"
                              class="form-control"
                              id="Address"
                              value=""
                              required
                              name="address"
                              placeholder="eg. Street, City, State, Country, Zip Code"
                            ></textarea>
                          </div>

                            <div class="col-md-6">
                              <label for="validationCustom02" class="form-label">Domain Name</label>
                              <input
                                type="text"
                                class="form-control"
                                id="Domain-Name"
                                value=""
                                required
                                name="domain_name"
                              />
                          </div>

                          <div class="card-header"><div class="card-title">Organization Admin Details</div></div>
                   
                     

                          <div class="col-md-6">
                            <label for="validationCustom01" class="form-label">Full Name</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Full-Name"
                              value=""
                              required
                              name="admin_name"
                            />
                          
                          </div>
                          <!--end::Col-->
                          <!--begin::Col-->
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Email (Admin Login)</label>
                            <input
                              type="email"
                              class="form-control"
                              id="Email-Admin-Login"
                              value=""
                              required
                              name="admin_email"
                            />
                           
                          </div>

                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Phone Number</label>
                            <input
                              type="number"
                              class="form-control"
                              id="Phone-Number-Admin-Login"
                              value=""
                              required
                              name="admin_phone"
                            />
                          </div>
                          <div class="col-md-6">
                            <label for="validationCustom02" class="form-label">Designation</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Designation"
                              value=""
                              required
                              placeholder="eg. CEO, Manager, Support Head, etc."
                              name="designation"
                            />
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
                                Agree to terms and conditions
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
                            <button class="btn btn-info" type="submit">Submit form</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                    <!--begin::JavaScript-->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function () {
                        $('#organization-form').submit(function (e) {
                            e.preventDefault(); // Prevent page reload
                            
                            // Custom validation
                            let isValid = true;
                            $('.form-control').each(function () {
                                if ($(this).prop('required') && $(this).val().trim() === '') {
                                    $(this).addClass('is-invalid'); // Add Bootstrap validation class
                                    isValid = false;
                                } else {
                                    $(this).removeClass('is-invalid').addClass('is-valid');
                                }
                            });
                    
                            if (!isValid) {
                                return; // Stop form submission if validation fails
                            }
                    
                            var formData = {
                                organization_name: $('#organization_name').val(),
                                official_email: $('#official_email').val(),
                                industry: $('#industry').val(),
                                organization_type: $('#organization_type').val(),
                                organization_size: $('#organization_size').val(),
                                website_url: $('#website_url').val(),
                                phone_number: $('#phone_number').val(),
                                address: $('#address').val(),
                                domain_name: $('#Domain-Name').val()
                            };
                    
                            $.ajax({
                                url: {{route('organization.store')}},
                                type: "POST",
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    alert("Organization added successfully!");
                                    $('#organization-form')[0].reset();
                                    $('.form-control').removeClass('is-valid'); // Remove validation styles
                                    $('#organizations-table').DataTable().ajax.reload(); // Reload table
                                },
                                error: function (xhr) {
                                    alert("Failed to add organization!");
                                    console.log("Error:", xhr.responseText);
                                }
                            });
                        });
                    
                        // Remove error class when user starts typing
                        $('.form-control').on('input', function () {
                            $(this).removeClass('is-invalid');
                        });
                    });

                    
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
          <!--end::App Content-->
        </main>

    </div>

    {{-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script> --}}

    @endsection
   