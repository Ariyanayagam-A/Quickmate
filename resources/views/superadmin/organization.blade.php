@extends('layouts.superadminlayout.app')

@section('title', 'Organizations')

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
                <p><strong>Designation:</strong> <span id="designation"></span></p>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function () {
            var table = $('#organizations-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('organizations.data') }}",
                columns: [
                    { data: 'organization_name', name: 'organization_name' },
                    { data: 'official_email', name: 'official_email' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        
            // Handle View Details Button Click
            $(document).ready(function () {
                $('#organizations-table').on('click', '.view-details', function () {
    var orgId = $(this).data('id');  
    console.log("Clicked Organization ID:", orgId);

    $.ajax({
        url: "/superadmin/organizations/" + orgId,
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
                $('#designation').text(response.designation || "N/A");
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
        
        });

        $(document).ready(function() {
            $(document).on('click', '.approve-btn', function () {
    var organizationId = $(this).data('id'); // Get the organization ID

    $.ajax({
        url: "/superadmin/organizations/approve/" + organizationId, 
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload(); // Refresh to reflect changes
                
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText); // Debugging errors
            alert('Error approving organization.');
        }
    });
});

}); 

$(document).on('click', '.delete-btn', function() {
        let organizationId = $(this).data('id');

        if (!confirm("Are you sure you want to delete this organization?")) return;

        $.ajax({
            url: "/superadmin/organizations/delete/" + organizationId, 
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

        </script>
        
@endsection

@push('scripts')

@endpush
