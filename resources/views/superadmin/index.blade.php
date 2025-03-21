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
    <div class="modal fade" id="organizationModal" tabindex="-1" aria-labelledby="orgModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orgModalLabel">Organization Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="org-name"></span></p>
                    <p><strong>Email:</strong> <span id="org-email"></span></p>
                    <p><strong>Industry:</strong> <span id="org-industry"></span></p>
                    <p><strong>Type:</strong> <span id="org-type"></span></p>
                    <p><strong>Size:</strong> <span id="org-size"></span></p>
                    <p><strong>Website:</strong> <span id="org-website"></span></p>
                    <p><strong>Phone:</strong> <span id="org-phone"></span></p>
                    <p><strong>Address:</strong> <span id="org-address"></span></p>
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
                var orgId = $(this).data('id');  // Get the ID of the clicked button
                console.log("Clicked Organization ID:", orgId); // Debugging
        
                $.ajax({
                    url: "/superadmin/organizations/" + orgId, // Fetch the data
                    type: "GET",
                    success: function (response) {
                        console.log("Response Data:", response); // Debugging
        
                        if (response) {
                            $('#org-name').text(response.organization_name || "N/A");
                            $('#org-email').text(response.official_email || "N/A");
                            $('#org-industry').text(response.industry || "N/A");
                            $('#org-type').text(response.organization_type || "N/A");
                            $('#org-size').text(response.organization_size || "N/A");
                            $('#org-website').text(response.website_url || "N/A");
                            $('#org-phone').text(response.phone_number || "N/A");
                            $('#org-address').text(response.address || "N/A");
        
                            $('#organizationModal').modal('show'); // Open the Bootstrap modal
                        } else {
                            alert("No data found!");
                        }
                    },
                    error: function (xhr) {
                        console.log("AJAX Error:", xhr.responseText); // Debugging
                        alert("Error fetching details!");
                    }
                });
            });
        });
        
        });
        </script>
        
@endsection

@push('scripts')

@endpush
