@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')

<section class="container mt-4">

    <h2 class="mb-4">Manage Groups</h2>

    <ul class="nav nav-tabs" id="groupTabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#supportDesk">Support Desk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#engineerDesk">Engineer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#userDesk">User</a>
        </li>
    </ul>

    <form action="" method="" class="mt-3">
        <div class="tab-content">
            <!-- Support Desk -->
            <div class="tab-pane fade show active" id="supportDesk">
                <h4 class="mt-3">Support Desk</h4>
                <div id="supportDeskUsers"></div>
                <button type="button" class="btn btn-primary mt-2" onclick="addUser('supportDeskUsers')">+ Add User</button>
            </div>

            <!-- Engineer Desk -->
            <div class="tab-pane fade" id="engineerDesk">
                <h4 class="mt-3">Engineer</h4>
                <div id="engineerDeskUsers"></div>
                <button type="button" class="btn btn-primary mt-2" onclick="addUser('engineerDeskUsers')">+ Add User</button>
            </div>

            <!-- User Desk -->
            <div class="tab-pane fade" id="userDesk">
                <h4 class="mt-3">User</h4>
                <div id="userDeskUsers"></div>
                <button type="button" class="btn btn-primary mt-2" onclick="addUser('userDeskUsers')">+ Add User</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-4">Submit</button>
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
    </script>
    {{-- <title>Organization Groups Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

</section>
@endsection