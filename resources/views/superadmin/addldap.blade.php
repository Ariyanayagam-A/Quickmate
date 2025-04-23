@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')


@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="app-content">
    <!--begin::Container-->
<div class="container-fluid">
      <!--begin::Row-->
<div class="row g-4">

<div class="card card-info card-outline mb-4">
<form id="organizationForm" action="{{route('superadmin.ldaporg.update')}}" method="POST"class="needs-validation" novalidate>
    @csrf
    <!--begin::Body-->
    <div class="card-body">
      <!--begin::Row-->
      <div class="row g-3">
        <!--begin::Col-->
        <div class="card-header"><div class="card-title">Organisational Details</div></div>

        <div class="col-md-6">
          <label for="validationCustom04" class="form-label">Select Organization</label>
          <select class="form-select" name="organization_id" id="organization_id" required>
          <option value="0"> Select Organization</option>
         @foreach($organizations as $org)
        <option value="{{ $org->id }}">{{ $org->organization_name }}</option>
        @endforeach
          </select>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">LDAP Admin Name</label>
            <input
              type="text"
              class="form-control"
              id="Industry"
              value=""
              placeholder="e.g. IT, Healthcare, Education, Finance, etc."
              required
              name="ldapadminname"
            />
            </div>

            <div class="col-md-6">
                <label for="validationCustom02" class="form-label">LDAP Admin Password</label>
                <input
                  type="text"
                  class="form-control"
                  id="Industry"
                  value=""
                  placeholder="e.g. IT, Healthcare, Education, Finance, etc."
                  required
                  name="ldapadminpassword"
                />
                </div>

                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Connection Url </label>
                    <input
                      type="text"
                      class="form-control"
                      id="Industry"
                      value=""
                      placeholder="e.g. IT, Healthcare, Education, Finance, etc."
                      required
                      name="connection_url"
                    />
                    </div>

                    <div class="col-md-6">
                      <label for="validationCustom02" class="form-label">Users DN:</label>
                      <input
                        type="text"
                        class="form-control"
                        id="Industry"
                        value=""
                        placeholder="OU=Mumbai,DC=demodc,DC=local"
                        required
                        name="users_dn"
                      />
                      </div>

        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-12">

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
          <div class="card-footer">
            <button class="btn btn-info" type="submit">Confirm</button>
          </div>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Row-->
    </div>
    <!--end::Body-->

    <!--begin::Footer-->

    <!--end::Footer-->
</form>
</div>
</div>
</div>
@endsection
