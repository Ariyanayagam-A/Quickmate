@extends('layouts.superadminlayout.app')

@section('title', 'Dashboard')

@section('content')


<div class="container mt-4">
    <h2 class="mb-4">Organizations List</h2>
    <table id="organizations-table" class="table table-striped">
        <thead>
            <tr>
                <th>Organization Name</th>
                <th>Official Email</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <!-- Update Modal -->
<!-- Update Organization Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Organization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="org_id" name="id">

                    <div class="mb-3">
                        <label class="form-label">Organization Name</label>
                        <input type="text" class="form-control" id="organization_name" name="organization_name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Industry</label>
                        <input type="text" class="form-control" id="industry" name="industry" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Organization Type</label>
                        <input type="text" class="form-control" id="organization_type" name="organization_type" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Organization Size</label>
                        <input type="text" class="form-control" id="organization_size" name="organization_size" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Website URL</label>
                        <input type="text" class="form-control" id="website_url" name="website_url">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Official Email</label>
                        <input type="email" class="form-control" id="official_email" name="official_email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Name</label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Email</label>
                        <input type="email" class="form-control" id="admin_email" name="admin_email">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Admin Phone</label>
                        <input type="text" class="form-control" id="admin_phone" name="admin_phone">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Domain Name</label>
                        <input type="text" class="form-control" id="domain_name" name="domain_name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        <img id="preview_logo" src="" class="img-fluid mt-2" style="max-height: 100px;">
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap Modal -->
<!-- Bootstrap Modal -->
<div class="modal fade" id="organizationModal" tabindex="-1" aria-labelledby="orgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Make modal larger -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orgModalLabel">Organization Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="org-logo" src="" alt="Organization Logo" class="img-fluid rounded" style="max-height: 150px;">
                </div>
                <hr>
                <p><strong>Name:</strong> <span id="org-name"></span></p>
                <p><strong>Email:</strong> <span id="org-email"></span></p>
                <p><strong>Industry:</strong> <span id="org-industry"></span></p>
                <p><strong>Type:</strong> <span id="org-type"></span></p>
                <p><strong>Domain Name:</strong> <span id="org-domain"></span></p>
                <p><strong>Size:</strong> <span id="org-size"></span></p>
                <p><strong>Website:</strong> <a href="#" id="org-website" target="_blank"></a></p>
                <p><strong>Phone:</strong> <span id="org-phone"></span></p>
                <p><strong>Address:</strong> <span id="org-address"></span></p>
                <p><strong>Admin Name:</strong> <span id="admin-name"></span></p>
                <p><strong>Admin Email:</strong> <span id="admin-email"></span></p>
                <p><strong>Admin Phone:</strong> <span id="admin-phone"></span></p>
                <p><strong>Designation:</strong> <span id="ldesignation"></span></p>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function () {
            var table = $('#organizations-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('org.list') }}",
                columns: [
                    { data: 'organization_name', name: 'organization_name'},
                    { data: 'official_email', name: 'official_email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

   // Handle View Details Button Click
   $(document).ready(function () {
                $('#organizations-table').on('click', '.view-details', function () {
    var orgId = $(this).data('id');  
    // console.log("Clicked Organization ID:", orgId);

    $.ajax({
        url: "{{ route('lisenseorganizations.show', ':id') }}".replace(':id', orgId),
        type: "GET",
        success: function (response) {
            console.log("Response Data:", response);

            if (response) {
                $('#org-name').text(response.organization_name || "N/A");
                $('#org-email').text(response.official_email || "N/A");
                $('#org-industry').text(response.industry || "N/A");
                $('#org-type').text(response.organization_type || "N/A");
                $('#org-size').text(response.organization_size || "N/A");
                $('#org-website').attr('href', response.website_url).text(response.website_url || "N/A");
                $('#org-phone').text(response.phone_number || "N/A");
                $('#org-address').text(response.address || "N/A");
                $('#admin-name').text(response.admin_name || "N/A");
                $('#admin-email').text(response.admin_email || "N/A");
                $('#admin-phone').text(response.admin_phone || "N/A");
                $('#ldesignation').text(response.designation || "N/A");
                $('#org-domain').text(response.domain_name || "N/A");
                // Check and display logo
                if (response.logo) {
                    $('#org-logo').attr('src', response.logo).show();
                } else {
                    $('#org-logo').hide(); // Hide if no logo available
                }

                $('#organizationModal').modal('show'); // Open the modal
            } else {
                alert("No data found!");
            }
        },
        error: function (xhr) {
            console.log("AJAX Error:", xhr.responseText);
            alert("Error fetching details!");
        }
    });
});
});

$(document).on('click', '.delete-btn', function() {
    
    let organizationId = $(this).data('id');

    if (!confirm("Are you sure you want to delete this organization?")) return;

    $.ajax({
        url: "/quickmate/organizations/delete/" + organizationId, // Correct URL format
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload();
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Error deleting organization.');
        }
    });
});

$(document).ready(function() {
    // Open update modal and fetch data from server
    $(document).on('click', '.update-btn', function () {
    let organizationId = $(this).data('id'); // Get the ID from data-id attribute
     $.ajax({
            url: '/quickmate/admin/organizations/' + organizationId + '/edit',
            type: 'GET',
            success: function(response) {  // "response" contains the full object
    let orgData = response.data; // Extract the actual organization data

    console.log(orgData); // Debugging step to confirm data

    $('#org_id').val(orgData.id);
    $('#organization_name').val(orgData.organization_name);
    $('#industry').val(orgData.industry);
    $('#organization_type').val(orgData.organization_type);
    $('#organization_size').val(orgData.organization_size);
    $('#website_url').val(orgData.website_url);
    $('#official_email').val(orgData.official_email);
    $('#phone_number').val(orgData.phone_number);
    $('#address').val(orgData.address);
    $('#admin_name').val(orgData.admin_name);
    $('#admin_email').val(orgData.admin_email);
    $('#admin_phone').val(orgData.admin_phone);
    $('#designation').val(orgData.designation);
    $('#domain_name').val(orgData.domain_name);

    // Set preview logo if exists
    if (orgData.logo) {
        $('#preview_logo').attr('src', '/storage/' + orgData.logo);
    } else {
        $('#preview_logo').attr('src', ''); // Empty image if no logo
    }

    $('#updateModal').modal('show'); // Show modal after setting values
}

        });
    });

    // Handle form submission for update
    $('#updateForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        let id = $('#org_id').val();

        $.ajax({
            url: '/quickmate/admin/organization/update/' + id,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                alert("Update failed! " + xhr.responseJSON.message);
            }
        });
    });
});


</script>

@endsection