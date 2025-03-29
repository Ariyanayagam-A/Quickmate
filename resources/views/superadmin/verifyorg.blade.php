@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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

              <form action="{{route('superadmin.verifyorg.update')}}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="organization_id" class="form-label">Select Organization</label>
                      <select class="form-select" name="organization_id" id="organization_id" required>
                        <option selected disabled value="">Select</option>
                        @foreach($organizations as $org)
                          <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12">
                      <label>Enable Authorization</label>
                      <label class="switch">
                        <input type="checkbox" name="authorization_enabled" value="1">
                        <span class="slider"></span>
                      </label>
                    </div>

                    <div class="col-md-12">
                      <label>Set Client Secret</label>
                      <label class="">
                        <input type="text" name="client_secret_enabled">
                        <span class="slider"></span>
                      </label>
                    </div>

                    <div class="col-md-12">
                        <label>New Role</label>
                        <label class="">
                          {{-- <input type="text" name=""> --}}
                          <input type="radio">
                          <span class="slider"></span>
                        </label>
                      </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                          Agree and Continue
                        </label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button class="btn btn-info" type="submit">Confirm</button>
                </div>
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

            </div>
          </div>
        </div>
      </div>
    </main>

</div>
@endsection
