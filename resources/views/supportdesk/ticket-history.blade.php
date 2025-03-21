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
                <table id="dataTable" class="ticketHistory table table-bordered table-striped align-middle m-0">
                  <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Ticket.no</th>
                      <th>Created On</th>
                      <th>Description</th>
                      <th>Category</th>
                      <th>Indicator</th>
                      <th>Status</th>
                      <th>level</th>
                      {{-- <th>Closed On</th> --}}
                      <th>Engineer</th>
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
      <!--end::App Main-->
      <!--begin::Footer-->
   
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->

  


    </body>
  <!--end::Body-->
  
<script>
$(function(){
  // 
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

  $('.ticketHistory').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('supportdesk.solvedtickets') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        {data: 'ticket_no', name: 'ticket_no'},
        {data: 'created_at', name: 'created_at'},
        {data: 'description', name: 'description'},
        {data: 'category', name: 'category'},
        {data: 'indicator', name: 'indicator'},
        {data: 'status', name: 'status'},
        {data: 'level', name: 'level'},
        // {data: 'closed_at', name: 'closed_at'},
        {data: 'assigned_to', name: 'assigned_to'},

    ]
  });

})
      </script>
@endsection