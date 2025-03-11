
      @extends('layouts.adminlayout.app')

      @section('title', 'Dashboard')
      
      @section('content')
      <!--end::Header-->
      <!--begin::Sidebar-->
     
      <!--end::Sidebar-->
      <!--begin::App Main-->
    <main class="app-main">

       <!-- Row start -->
       <div class="dropdown m-3">
        <button class="btn btn-drp dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Tickets
        </button>
      <!-- Dropdown for filtering tickets -->
      <ul class="dropdown-menu dropdown-menu-dark-bg">
        <li><a class="dropdown-item drp-clr" href="#" data-status="">All-Tickets</a></li>
        <li><a class="dropdown-item drp-clr" href="#" data-status="Rejected">Rejected</a></li>
        <li><a class="dropdown-item drp-clr" href="#" data-status="Solved">Solved</a></li>
        <li><a class="dropdown-item drp-clr" href="#" data-status="Open">Open</a></li>
        <li><a class="dropdown-item drp-clr" href="#" data-status="On Hold">On Hold</a></li>
      </ul>

      
      
      </div>

       <div class="row">
        <div class="col-12 col-xl-6">

          <!-- Breadcrumb start -->
         

          <ol class="breadcrumb m-3">
            <li class="breadcrumb-item ">
              Activities
            </li>
            <li class="breadcrumb-item ">
              All My Activities
            </li>
            <li class="breadcrumb-item ">
              All Ticket
            </li>
          </ol>
          <!-- Breadcrumb end -->

        </div>
      </div>
      {{-- <input type="text" id="searchBox" onkeyup="searchTable()" class="form-control mb-3" placeholder="Search .."> --}}
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

           <!-- Ticket Image -->
    <div class="form-group mb-3">
      <label for="ticketImage" class="form-label">Ticket Image</label>
      <img id="ticketImage" src="" alt="Ticket Image" class="img-fluid" style="max-width: 100%; height: auto;">
  </div>

          {{-- <!-- Ticket Feedback -->
          <div class="form-group mb-3">
            <label for="feedback" class="form-label">Ticket Feedback</label>
            <textarea 
              name="feedback" 
              id="feedback" 
              class="form-control" 
              rows="4"></textarea>
          </div> --}}
          
          <!-- Submit Button -->
          {{-- <div class="d-flex justify-content-center">
            <button 
              id="submitBtn" 
              class="btn btn-primary btn-sm px-4">
              Submit
            </button>
          </div> --}}
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


  <!-- Assign Ticket Modal -->
<div class="modal fade" id="assignTicketModal" tabindex="-1" aria-labelledby="assignTicketLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignTicketLabel">Assign Ticket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="assignTicketForm">
          <input type="hidden" id="ticket_id" name="ticket_id">
          <div class="mb-3">
            <label for="assignee" class="form-label">Assign to Engineer</label>
            <select class="form-control" id="assignee" name="assignee" required>
              <option value="" selected disabled>-- Select Engineer --</option>
              <option value="3">Sabari</option>
              <option value="4">Karthikeyan</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="priority" class="form-label">Priority Level</label>
            <select class="form-control" id="priority" name="priority" required>
              <option value="" selected disabled>-- Select Priority --</option>
              <option value="1">L1</option>
              <option value="2">L2</option>
              <option value="3">L3</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Assign Ticket</button>
        </form>
      </div>
    </div>
  </div>
</div>



      <!-- Modal for Viewing Ticket Details -->

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
    

    </main>
    </div>


  


    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <script>
   $(function() {

      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });

        console.log($('.tickets')); // Ensure it logs the table element

        var table = $('.ticketstable').DataTable({
        processing: true,
        serverSide: true,
        "ordering": false,
        ajax: "{{ route('tickets.adminlist') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data : 'ticket_no', name: 'ticket_no'},
            {data : 'requested_by', name: 'requested_by'},
            {data : 'email', name: 'email'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'assigned_to', name: 'assigned_to'},
            {data: 'indicator', name: 'indicator'},
            {data: 'level', name: 'level'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });  

       // Dropdown filter functionality
       $(document).on('click', '.dropdown-item', function (e) {
        e.preventDefault(); // Prevent page reload
        
        var status = $(this).data('status');  // Get the clicked status text

        if (status === "") {
            table.column(9).search('').draw(); // Show all tickets
        } else {
            table.column(9).search(status).draw(); // Filter by status
        }
    });

    });
    
    function viewTicket(ticketId) {
    $('#ticketid').val(ticketId);
    $.ajax({
        url: `ticket/view/${ticketId}`,
        type: 'GET',
        contentType: 'application/json',
        success: function(response) {
            console.log('response : ', response);
            if (response.status == 'success') {
                console.log('response data => ', response.data);

                // Populate the form fields
                $('#subject').val(response.data.subject);
                $('#description').val(response.data.summary);
                $('#feedback').val(response.data.feedback);

                // Set the image source
                if (response.data.image) {
                    const imageUrl = `/storage/${response.data.image}`;
                    // console.log('Image URL:', imageUrl); // Debugging: Check the constructed URL
                    $('#ticketImage').attr('src', imageUrl);
                    $('#ticketImage').show(); // Show the image element
                } else {
                    $('#ticketImage').hide(); // Hide the image element if no file is uploaded
                }

                // Show the modal
                $('#myModal').show();
            } else {
                alert('Something went wrong');
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}

$('.close').click(function(){
          $('#myModal').hide();
        })

        


    </script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const urlParams = new URLSearchParams(window.location.search);
      const currentStatus = urlParams.get("status") || ""; // Get status from URL

      document.querySelectorAll(".dropdown-item").forEach(item => {
          if (item.getAttribute("data-status") === currentStatus) {
              item.classList.add("active");
          } else {
              item.classList.remove("active");
          }

          // Change status when clicking a dropdown item
          item.addEventListener("click", function () {
              document.querySelectorAll(".dropdown-item").forEach(i => i.classList.remove("active"));
              this.classList.add("active");

              // Update URL (optional)
              const newUrl = new URL(window.location);
              newUrl.searchParams.set("status", this.getAttribute("data-status"));
              window.history.pushState({}, "", newUrl);
          });
      });
  });
</script>

<script>
  $(document).ready(function () {
      // Open modal when clicking the "Assign Ticket" button
      $(document).on('click', '.assign-ticket-btn', function () {
          let ticketId = $(this).data('id');
          $('#ticket_id').val(ticketId); // Set hidden input value
          $('#assignTicketModal').modal('show'); // Show the modal
      });
  
      // Handle form submission
      $('#assignTicketForm').submit(function (e) {
          e.preventDefault();
  
          let ticketId = $('#ticket_id').val();
          let assignee = $('#assignee').val();
          let priority = $('#priority').val();
  
          $.ajax({
              url: "{{ route('assign.ticket-admin') }}", // Route to handle assignment
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  ticket_id: ticketId,
                  assignee: assignee,
                  priority: priority
              },
              success: function (response) {
                  alert(response.message); // Show success message
                  $('#assignTicketModal').modal('hide'); // Hide modal
                  $('.ticketstable').DataTable().ajax.reload(); // Reload DataTable
              },
              error: function (xhr) {
            let errorMessage = xhr.responseJSON.message;
            alert(errorMessage); // Show error message if already assigned
             }
          });
      });
  });

  $(document).on("click", ".delete-ticket-btn", function () {
    let ticketId = $(this).data("id");

    if (!confirm("Are you sure you want to reject this ticket?")) {
        return;
    }

    $.ajax({
        url: "{{ route('reject.ticket') }}", // Create this route in web.php
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            ticket_id: ticketId
        },
        success: function (response) {
            alert(response.message);
            location.reload(); // Refresh the table after status update
        },
        error: function (xhr) {
            alert("Something went wrong!");
        }
    });
});

  </script>


  
  </body>
</html>
@endsection