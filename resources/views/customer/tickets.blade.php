@extends('layouts.engineerlayout.app')

@section('title', 'Agent Page')

@section('content')



      
             <div class="row">
              <div class="col-12">
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="dataTable" class="tickets table table-bordered table-striped align-middle m-0 ">
                        <thead>
                          <tr>
                          <th>#</th>
                          <th>Ticket No</th>
                          <th>Subject</th>
                          <th>category</th>
                          <th>Summary</th>
                          {{-- <th>assignee</th> --}}
                          <th>status</th>
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
   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}

<link rel="stylesheet" href="{{ asset('assets/dist/css/jquery.dataTables.min.css')}}" />

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


    {{-- <script>
   $(document).ready(function () {
    var table = $('.tickets').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('tickets.list') }}",
            type: "GET",
            dataType: "json",
            beforeSend: function () {
                console.log("Fetching data from server...");
            },
            success: function (response) {
                console.log(response+ "tickets response data"); // ✅ Logs response in console
            },
            error: function (xhr, error, code) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'ticket_id', name: 'ticket_id' },
            // { data: 'subject', name: 'subject' },
            // { data: 'raised_by', name: 'raised_by' },
            // { data: 'image', name: 'image' },
            // { data: 'category', name: 'category' },
            // { data: 'summary', name: 'summary' },
            // { data: 'priority', name: 'priority' },
            // { data: 'assignee', name: 'assignee' },
            // { data: 'feedback', name: 'feedback' },
            // { data: 'status', name: 'status' },
            // { data: 'created_at', name: 'created_at' },
            // { data: 'updated_at', name: 'updated_at' },
            // { data: 'ticket_no', name: 'ticket_no' },
            // { data: 'title', name: 'title' },
            // { data: 'description', name: 'description' },
            // { data: 'level', name: 'level' },
            // { data: 'action', name: 'action' },
            // { data: 'feedback', name: 'action', orderable: false, searchable: false }
        ],
        error: function (xhr, error, code) {
            console.log("Error:", xhr.responseText);
        }
    });
}); --}}

<script>
$(function() {
  console.log($('.tickets')); // Ensure it logs the table element

  var table = $('.tickets').DataTable({
  processing: true,
  serverSide: true,
  ajax: "{{ route('tickets.list') }}",
 
  columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'ticket_id', name: 'ticket_id' },
        { data: 'subject', name: 'subject' },
        { data: 'category', name: 'category' },
        { data: 'summary', name: 'summary' },
        { data: 'status', name: 'status' }
    ],
   
});  

});
       
    </script>
@endsection