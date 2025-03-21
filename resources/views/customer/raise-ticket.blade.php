@extends('layouts.engineerlayout.app')

@section('title', 'Agent Page')

@section('content')


<div class="card card-info card-outline mb-4">
  <!--begin::Header-->
  <div class="card-header"><div class="card-title">Raise a new Ticket</div></div>
  @if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show mt-2 sessionclose" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close closeicon" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if (session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-2 sessionclose" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close closeicon" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif


  {{-- <form =""> --}}
    <form class="needs-validation" action="{{ route('raise.ticket') }}" method="POST" enctype="multipart/form-data" novalidate>
      @csrf
      <!--begin::Body-->
      <div class="card-body">
          <div class="row g-3">
              <!-- Title -->
              <div class="col-md-6">
                  <label for="validationCustom01" class="form-label">Title</label>
                  <input type="text" class="form-control" id="validationCustom01" name="title" required>
                  <div class="valid-feedback">Good!</div>
              </div>
  
              <!-- Description -->
              <div class="col-md-6">
                  <label for="validationCustom02" class="form-label">Description</label>
                  <input type="text" class="form-control" id="validationCustom02" name="desc" required>
                  <div class="valid-feedback">Good!</div>
              </div>

               <!-- Replace 1 with actual user ID -->

  
              <!-- Category -->
              <div class="col-md-6">
                  <label for="validationCustom04" class="form-label">Category</label>
                  <select class="form-select" id="validationCustom04" name="category" required>
                      <option value="" disabled selected>--- Select Category ---</option>
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                  <div class="invalid-feedback">Please select a valid category.</div>
              </div>
  
              <!-- File Upload -->
              <div class="col-md-6">
                  <label for="inputGroupFile02" class="form-label">Upload File</label>
                  <div class="input-group mb-3">
                      <input type="file" class="form-control" id="inputGroupFile02" name="ticket_file">
                      <label class="input-group-text" for="inputGroupFile02">Upload</label>
                  </div>
              </div>
  
              <!-- Terms & Conditions -->
              <div class="col-12">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="invalidCheck" required>
                      <label class="form-check-label" for="invalidCheck">
                        Accept and Raise Ticket
                      </label>
                      <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
              </div>
          </div>
      </div>
  
      <!-- Submit Button -->
      <div class="card-footer">
          <button class="btn btn-info" type="submit">Submit Form</button>
      </div>
  </form>
  
  <!--end::Form-->
  <!--begin::JavaScript-->
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


    <script>
      $(function(){
        $('.closeicon').click(function(){
            $('.sessionclose').css('display','none');
        })
      })
    </script>
@endsection