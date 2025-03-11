@extends('layouts.supportteamlayout.app')

@section('title', 'Support Page')

@section('content')

    <main class="app-main">

       <!-- Row start -->

    


       <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-body">
              <div class="table-responsive">
                <table id="dataTable" class="newticketsTable table table-bordered table-striped align-middle m-0" style="inherit">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Ticket.no</th>
                      <th>Created On</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Users Mail</th>
                      <th>Engineers</th>
                      <th>level</th>
                      <th>Assign</th>
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
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
   
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->
 
   

    <!--end::Script-->
  </body>
  <!--end::Body-->
  <script>
    function searchTable() {
        let input = document.getElementById("searchBox").value.toLowerCase();
        let table = document.getElementById("dataTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip header row
            let cells = rows[i].getElementsByTagName("td");
            let found = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(input)) {
                    found = true;
                    break;
                }
            }

            rows[i].style.display = found ? "" : "none"; // Show/hide rows based on search
        }
    }
</script>
<script>
$(function(){

  document.addEventListener("DOMContentLoaded", function () {
    const sidebarContact = document.querySelector(".sidebar-contact");
    const contactForm = document.getElementById("contactForm");
    const sendButton = document.getElementById("sendButton");
    const customAlert = document.getElementById("customAlert");
    const closeAlert = document.getElementById("closeAlert");
  
    sidebarContact.addEventListener("click", function () {
      // Toggle visibility of the contact form
      if (contactForm.style.display === "none" || contactForm.style.display === "") {
        contactForm.style.display = "block";
      } else {
        contactForm.style.display = "none";
      }
    });
  
    sendButton.addEventListener("click", function () {
      const message = document.getElementById("contactMessage").value.trim();
      if (message) {
        // Show the custom alert
        customAlert.style.display = "flex";
  
        // Clear the message box
        document.getElementById("contactMessage").value = "";
  
        // Hide the form
        contactForm.style.display = "none";
      } else {
        alert("Please enter a message before sending.");
      }
    });
  
    closeAlert.addEventListener("click", function () {
      // Hide the custom alert
      customAlert.style.display = "none";
    });
  });

  $('.newticketsTable').DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    ajax: "{{ route('supportdesk.alltickets') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        {data: 'ticket_no', name: 'ticket_no'},
        {data: 'created_at', name: 'created_at'},
        {data: 'description', name: 'description'},
        {data: 'category', name: 'category'},
        {data: 'users_mail', name: 'users_mail'},
        {data: 'engineers', name: 'engineers'},
        {data: 'level', name: 'level'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
  });
  
      
})
      </script>

<script>
 $(document).ready(function() {
    $(document).on('click', '.update-ticket', function() {
        var ticketId = $(this).data('id');
        var assignee = $('.engineers[data-id="'+ticketId+'"]').val();
        var priority = $('.level[data-id="'+ticketId+'"]').val();

        if (!assignee || !priority) {
            alert("Please select both Assignee and Priority before updating.");
            return;
        }

        $.ajax({
            url: '/update-ticket/' + ticketId,
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                assignee: assignee,
                priority: priority
            },
            success: function(response) {
                alert(response.message);
                location.reload(); // Refresh table
            },
            error: function(xhr) {
                alert("Error: " + xhr.responseJSON.message);
            }
        });
    });
});
</script>
  
</html>
@endsection