@extends('layouts.supportlayout.app')

@section('title', 'Agent Page')

@section('content')


 

 
    <main class="app-main">
    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- App container starts -->
      <div class="app-container">

        <!-- App header starts -->
       
        <!-- App header ends -->

        <!-- App navbar starts -->
       
        <!-- App Navbar ends -->

        <!-- App body starts -->
        <nav class="navbar navbar-expand-lg p-0">
          <div class="container">
            <div class="offcanvas offcanvas-end" id="MobileMenu">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title semibold">Navigation</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                  <i class="icon-clear"></i>
                </button>
              </div>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
               
               <!-- Assign model -->
               <div class="modal modal-lg" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Support Ticket</h4>
                      <button type="button" class="btn-close close" data-bs-dismiss="modal"></button>
                      {{-- <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Close</button> --}}
                    </div>

                    <div class="modal-body">
                      <h2 class="text-center mb-4">Ticket Details</h2>
                      
                      <!-- Ticket Subject -->
                      <div class="form-group mb-3">
                        <label for="subject" class="form-label">Ticket Subject</label>
                        <input 
                          type="text" 
                          name="subject" 
                          id="subject" 
                          class="form-control" readonly>
                      </div>
                      
                      <!-- Ticket Description -->
                      <div class="form-group mb-3">
                        <label for="description" class="form-label">Ticket Description</label>
                        <textarea 
                          name="description" 
                          id="description" 
                          class="form-control" 
                          rows="4" readonly></textarea>
                      </div>

                      <!-- Ticket Feedback -->
                      <div class="form-group mb-3">
                        <label for="feedback" class="form-label">Ticket Feedback</label>
                        <textarea 
                          name="feedback" 
                          id="feedback" 
                          class="form-control" 
                          rows="4"></textarea>
                      </div>
                      
                      <!-- Submit Button -->
                      <div class="d-flex justify-content-center">
                        <button 
                          id="submitBtn" 
                          class="btn btn-primary btn-sm px-4">
                          Submit
                        </button>
                      </div>
                    </div>


                    <input type="hidden" name="ticketid" id="ticketid" value="">
                    <input type="hidden" name="is_edit" id="is_edit" value="0">
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Close</button>
                    </div>

                  </div>
                </div>
              </div>
               <!-- Assign model -->
              </ul>
            </div>
          </div>
        </nav>
        <div class="app-body">

          <!-- Container starts -->
          <div class="container">

            <!-- Row start -->
          
            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
              <div class="col-12">
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered table-striped align-middle m-0 tickets">
                        <thead>
                          <tr>
                            <th>S.no</th>
                            {{-- <th>View Ticket</th> --}}
                            <th>Request by</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Actions</th>
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
            <!-- Row end -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App body ends -->

        <!-- App footer start -->
       
        <!-- App footer end -->

      </div>
      <!-- App container ends -->

    </div>
  </main>
  <!--end::App Main-->
 
</div>
    <!-- Page wrapper end -->

    <!-- Custom JS files -->
    <script type="text/javascript">
        $(function() {

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log($('.tickets')); // Ensure it logs the table element

        var table = $('.tickets').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('agentholdtickets.list') }}",
        initComplete: function () {
          console.log('initComplete');
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            // {data : 'view', name: 'view'},
            {data : 'request_by', name: 'request_by'},
            {data: 'email', name: 'email'},
            {data: 'subject', name: 'subject'},
            {data: 'status', name: 'status'},
            {data:'priority', name:'priority'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  

        $('.close').click(function(){
          $('#myModal').hide();
        })

        $('#submitBtn').click(function()
        {
          
          if (($('#feedback').val() == '' )) {
            alert('Please enter a Feedback.');
            return;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

          var data = {
            feedback : $('#feedback').val(),
            ticketId    : $('#ticketid').val(),
          }

          commonAjax(data);

        })
      });

        function commonAjax(payload)
        {
          $.ajax({
            url: "{{ route('solveticket') }}",
            type: 'POST',
            data: JSON.stringify(payload), 
            contentType: 'application/json',
            success: function(response){
              console.log('response : ',response);
              if(response.status == 'success')
              {
                alert(response.message);
                $('#myModal').hide();
                setTimeout(()=> $('#table').DataTable().ajax.reload(),1000);
              }
              else{
                alert('Something went wrong');
              }

            },
            error: function(error){
              console.log(error);
            }
          });
        }

        function viewTicket(ticketId)
        {
          $('#ticketid').val(ticketId)
          $.ajax({
            url: "{{ route('ticket.view', ':id') }}".replace(':id', ticketId),
            type: 'GET',
            contentType: 'application/json',
            success: function(response){
              console.log('response : ',response);
              if(response.status == 'success')
              {
                console.log('response data => ',response.data);
                $('#subject').val(response.data.subject);
                $('#description').val(response.data.summary);
                $('#feedback').val(response.data.feedback);
                $('#myModal').show();
              }
              else{
                alert('Something went wrong');
              }

            },
            error: function(error){
              console.log(error);
            }
          });


        }

        function closeRejectTicket(object,ticketId)
        {
          // console.log('type : ',);
          var ticketStatus = $(object).attr('data-type') == 'close' ? '2' : ($(object).attr('data-type') == 'hold' ? '4' : '3');
          var message = `Are you sure you want to ${$(object).attr('data-type')} this ticket`;

          if(!$(object).attr('data-hasfeedback'))
          {
            alert(`Please Open the Ticket and fill a feedback`)
            return; 
          }
          
          if(confirm(message)){
            var payload = {
              ticketId : ticketId,
              status : ticketStatus
            }
            commonAjax(payload);
          }
          else{
            return;
          }

        }
        
    </script>
 @endsection