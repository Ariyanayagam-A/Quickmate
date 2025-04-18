@extends('layouts.adminlayout.app')

@section('title', 'Dashboard')

@section('content')
<main class="app-main">

 <!-- Row start -->

 <label for="assignee" class="form-label" style="margin: 13px;
    font-weight: 700;">Filter By Engineer</label>
 <select class="form-control" id="assignee" name="assignee" style="
 width: 20%;
 padding: 10px;
 margin: 8px;
 border-radius: 8px;" required>
     <option value="" selected disabled>-- Select Engineer --</option>
 </select>

 <a href="#" class="btn btn-success mb-3" id="exportExcel" style="color: white; background-color: #28a745; padding: 10px 15px; font-size: 16px; border-radius: 5px; text-align: center; text-decoration: none; width: 279px; margin: 8px; border: none; cursor: pointer;">
  Download Filtered Report (Excel)
</a>


 <div class="row">
  <div class="col-12 col-xl-6">
    <ol class="breadcrumb m-3">
      <li class="breadcrumb-item ">
        Reports
      </li>
    </ol>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card mb-2">
      <div class="card-body">
        <div class="table-responsive">
          <table id="dataTable" class="table ticketstable table-bordered table-striped align-middle m-0">
            <thead>
              <tr>
                <th></th>
                <th>Ticket ID</th>
                <th>Requested by</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Category </th>
                <th>Engineer</th>
                <th>Indicator</th>
                <th>Level</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Assigned At</th>
                <th>Rejected At</th>
                <th>Solved At</th>
              </tr>
            </thead>
             <tbody>
             </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</main>

<script>
  $(function() {
    // Initialize DataTable
    var table = $('.ticketstable').DataTable({
    processing: true,
    serverSide: true,
    ordering: false,
    ajax: "{{ route('tickets.reprotslist') }}",

    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'ticket_no', name: 'ticket_no' },
        { data: 'requested_by', name: 'requested_by' },
        { data: 'email', name: 'email' },
        { data: 'title', name: 'title' },
        { data: 'category', name: 'category' },
        { data: 'assigned_to', name: 'assigned_to' },
        { data: 'indicator', name: 'indicator' },
        { data: 'level', name: 'level' },
        { data: 'status', name: 'status' },
        { data: 'created_at', name: 'created_at' },
        { data: 'assigned_at', name: 'assigned_at' },
        { data: 'closed_at', name: 'closed_at' },
        { data: 'deleted_at', name: 'deleted_at' }
    ]
});

    // Dropdown filter functionality
    $('#assignee').on('focus', function () {  // Trigger when the dropdown is focused/opened
        $('#assignee').empty().append('<option selected disabled>Loading...</option>');

        // Fetch engineers dynamically
        $.ajax({
            url: '{{route('engineers.list.report')}}', 
            type: 'GET',
            success: function (response) {
                if (response.status) {
                    let options = '<option value="" selected disabled>-- Select Engineer --</option>';
                    response.engineers.forEach(engineer => {
                      options += `<option value="${engineer.id}" data-name="${engineer.name}">${engineer.name}</option>`;
                    });
                    $('#assignee').html(options);
                } else {
                    alert("No engineers found.");
                    $('#assignee').html('<option disabled>No engineers available</option>');
                }
            },
            error: function () {
                alert("Failed to load engineers.");
                $('#assignee').html('<option disabled>Error loading engineers</option>');
            }
        });
    });

    // Filter the DataTable by selected engineer
    $('#assignee').on('change', function () {
    var selectedName = $(this).find(':selected').data('name'); // Get engineer name
    if (!selectedName) {
        table.column(6).search('').draw(); // Show all
    } else {
        table.column(6).search(selectedName).draw(); // Filter by name
    }
});

  });
  $('#exportExcel').on('click', function (e) {
    e.preventDefault();

    let selectedEngineerId = $('#assignee').val();
    if (!selectedEngineerId) {
        alert("Please select an engineer to export the report.");
        return;
    }

    let url = `{{ route('tickets.reports.export') }}?engineer_id=${selectedEngineerId}`;
    window.location.href = url; // Triggers the file download
});

</script>
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />

<!-- Buttons JS (includes Excel export) -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<!-- JSZip for Excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>

@endsection
