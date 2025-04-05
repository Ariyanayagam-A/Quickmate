@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')

<section class="container mt-4">

    <h2 class="mb-4">Manage Users</h2>
    <form action="" method="" class="mt-3">
    <table id="usersTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
    </form>
    <script>
        function addUser(groupId) {
            let container = document.getElementById(groupId);
            let div = document.createElement("div");
            div.classList.add("row", "mb-2");
            div.innerHTML = `
                <div class="col-md-5">
                    <input type="email" class="form-control" name="${groupId}Emails[]" placeholder="User Email" required>
                </div>
                <div class="col-md-5">
                    <input type="password" class="form-control" name="${groupId}Passwords[]" placeholder="Password" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remove</button>
                </div>
            `;
            container.appendChild(div);
        }

        $(document).ready(function() {

            $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'fname', name: 'fname' },
                    { data: 'lname', name: 'lname' },
                    { data: 'email', name: 'email' },
                    { data: 'roles', name: 'roles' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Delete User
            $(document).on('click', '.deleteUser', function() {
                var userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '/users/' + userId,
                        type: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function(response) {
                            alert(response.message);
                            $('#usersTable').DataTable().ajax.reload();
                        }
                    });
                }
            });

            // Assign Role (You can implement a modal for better UX)
            // $(document).on('click', '.assignRole', function(e) {
            //     e.preventDefault();

            //     // roleAssignmentModal();
            //     // var userId = $(this).data('id');
            //     //var role = prompt("Enter Role Name:");
            //     if (role) {
            //         $.ajax({
            //             url: '{{ route("users.assignRole") }}',
            //             type: 'POST',
            //             data: { user_id: userId, role: role },
            //             headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            //             success: function(response) {
            //                 alert(response.message);
            //                 $('#usersTable').DataTable().ajax.reload();
            //             }
            //         });
            //     }
            // });
        });

    </script>
    {{-- <title>Organization Groups Form</title> --}}

<!-- Assign Role Modal -->
<div class="modal fade" id="assignRoleModal" tabindex="-1" aria-labelledby="assignRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignRoleModalLabel">Assign Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignRoleForm">
                    <input type="hidden" id="userId" name="user_id">
                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select class="form-control" id="role" name="role">
                            @foreach ($roles as $role)
                                <option value="{{ $role['id'] }}" data-name="{{ $role['name'] }}">{{ $role['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="assignRoleButton">Assign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    $("#assignRoleButton").click(function (e) {
        e.preventDefault(); // Prevent default form submission
        let userId = $("#userId").val();
        let roleId = $("#role").val();
        let roleName = $("#role option:selected").data('name'); // Get the selected role name

        console.log('userId: ', userId);
        console.log('roleId: ', roleId);
        console.log('roleName: ', roleName);

        $.ajax({
            url: "{{ route('users.assignRole') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                user_id: userId,
                role_id: roleId,  // Send role ID
                role_name: roleName // Send role name
            },
            success: function (response) {
                console.log('response: ', response);
                if (response.status) {
                    alert("Role assigned successfully!");
                    // $("#assignRoleModal").modal("hide"); // Close the modal
                    $('#usersTable').DataTable().ajax.reload(); // Reload the table
                } else {
                    alert("Failed to assign role: " + response.message);
                }
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseText);
            }
        });
    });
});


function openRoleAssignModal(userid)
{
    $('#userId').val(userid)

    // console.log('popup : ',data)
}
</script>
@endsection
