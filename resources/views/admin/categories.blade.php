<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin <?=
   isset($activeLink) && !empty($activeLink) ? ucfirst($activeLink) : ''?> </title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards" />
    <meta name="author" content="Bootstrap Gallery" />
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="assets/images/favicon.svg" />

    <!-- *************
			************ CSS Files *************
		************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}" />

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- datatables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

  </head>

  <body>

    <!-- Page wrapper start -->
    <div class="page-wrapper">

      <!-- App container starts -->
      <div class="app-container">

        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">

          <!-- Container starts -->
          <div class="container">

            <!-- Row starts -->
            <div class="row">
              <div class="col-md-3 col-2">

                <!-- App brand starts -->
                <div class="app-brand">
                  <a href="index.html" class="d-lg-block d-none">
                    <img src="{{ asset('assets/images/logo-qickmate.png')}}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                  <a href="index.html" class="d-lg-none d-md-block">
                    <img src="{{ asset('assets/images/logo-qickmate.png') }}" class="logo" alt="Bootstrap Gallery" />
                  </a>
                </div>
                <!-- App brand ends -->

              </div>

              <div class="col-md-9 col-10">
                <!-- App header actions start -->
                <div class="header-actions d-flex align-items-center justify-content-end">

                  <!-- Search container start -->
                  <!-- <div class="search-container d-none d-lg-block">
                    <input type="text" class="form-control" placeholder="Search" />
                    <i class="icon-search"></i>
                  </div> -->
                  <!-- Search container end -->

                  <!-- <div class="dropdown">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="assets/images/flags/1x1/br.svg" class="flag-img" alt="Brazil" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-sm dropdown-menu-mini">
                      <div class="country-container">
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/us.svg" alt="USA" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/in.svg" alt="India" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/tr.svg" alt="Turkey" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/gb.svg" alt="Great Britain" />
                        </a>
                        <a href="index.html" class="py-2">
                          <img src="assets/images/flags/1x1/id.svg" alt="Indonesia" />
                        </a>
                      </div>
                    </div>
                  </div> -->
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-regular fa-envelope"></i>
                      <span class="count rounded-circle bg-danger">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Messages</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-danger rounded-circle me-3">
                            MS
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Moory Sammy</h6>
                            <p class="mb-1">Sent a mail.</p>
                            <p class="small m-0 opacity-50">3 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-primary rounded-circle me-3">
                            KY
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Kyle Yomaha</h6>
                            <p class="mb-1">Need support.</p>
                            <p class="small m-0 opacity-50">5 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <div class="p-3 bg-success rounded-circle me-3">
                            SB
                          </div>
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Srinu Basava</h6>
                            <p class="mb-1">Purchased a NotePad.</p>
                            <p class="small m-0 opacity-50">7 Mins Ago</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown d-sm-block d-none">
                    <a class="dropdown-toggle d-flex p-3 position-relative" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-regular fa-message"></i>
                      <span class="count rounded-circle bg-danger">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md shadow-sm">
                      <h5 class="fw-semibold px-3 py-2 m-0">Notifications</h5>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user.png" class="img-3x me-3 rounded-3" alt="Admin Themes" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Membership has been ended.</p>
                            <p class="small m-0 opacity-50">Today, 07:30pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user2.png" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">Congratulate, James for new job.</p>
                            <p class="small m-0 opacity-50">Today, 08:00pm</p>
                          </div>
                        </div>
                      </a>
                      <a href="javascript:void(0)" class="dropdown-item">
                        <div class="d-flex align-items-start py-2">
                          <img src="assets/images/user1.png" class="img-3x me-3 rounded-3" alt="Admin Theme" />
                          <div class="m-0">
                            <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                            <p class="mb-1">
                              Lewis added new schedule release.
                            </p>
                            <p class="small m-0 opacity-50">Today, 09:30pm</p>
                          </div>
                        </div>
                      </a>
                      <div class="d-grid p-3 border-top">
                        <a href="javascript:void(0)" class="btn btn-outline-primary">View all</a>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown ms-2">
                    <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="d-none d-md-block">{{ auth()->user()->name}}</span>
                      <img src="{{ asset('assets/images/user3.png')}}" class="img-3x m-2 me-0 rounded-5" alt="Bootstrap Gallery" />
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout')}}" method="POST" style="display: none;">
                    @csrf    
                    </form>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3">
                      <a class="dropdown-item d-flex align-items-center py-2" href="agent-profile.html">User Profile</a>
                      <a class="dropdown-item d-flex align-items-center py-2" href="account-settings.html">
                          Account
                        Settings</a>
                        <a href="#" class="dropdown-item d-flex align-items-center py-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                      
                    </div>
                  </div>

                  <!-- Toggle Menu starts -->
                  <button class="btn btn-success btn-sm ms-3 d-lg-none d-md-block" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#MobileMenu">
                    <i class="icon-menu"></i>
                  </button>
                  <!-- Toggle Menu ends -->

                </div>
                <!-- App header actions end -->

              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- Container ends -->

        </div>
        <!-- App header ends -->

        <!-- App navbar starts -->
        @include('admin.layouts.navbar')
        <!-- App Navbar ends -->

        <!-- App body starts -->
        <div class="app-body">

          <!-- Container starts -->
          <div class="container">

            <!-- Row start -->
            <div class="row">
              <div class="col-12 col-xl-6">

                <!-- Breadcrumb start -->
                <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item">
                    <i class="fa-solid fa-house"></i>
                    <a href="agents.html" class="text-decoration-none">Home</a>
                  </li>
                  <li class="breadcrumb-item text-light">
                    <i class="fa-solid fa-greater-than"></i>
                    Admin</li>
                    <li class="breadcrumb-item text-light">
                    <i class="fa-solid fa-greater-than"></i>
                    Tickets</li>
                </ol>
              </div>
            </div>
            <!-- Row end -->

            <!-- Row start -->
            <div class="row">
            <div class="col-12 col-xl-2">
                      <div>
                        <a href="#" onclick="CategoryModalAction(this,null)" data-action="add">
                            <button type="button" class="btn btn-info" fdprocessedid="im3l2s">
                              Add Category
                            </button>
                          </a>
                      </div>
              </div>
            </div>
              <div class="col-12 mt-2">
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="table" class="table table-bordered table-striped align-middle m-0 categories">
                        <thead>
                          <tr style="text-align: center;">
                            <th>#</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: center; "></tbody>

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
        <div class="app-footer">
          <div class="container">
            <span>© Azeusbros</span>
          </div>
        </div>
        <!-- App footer end -->
<!-- Category model -->
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Category</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                      <form id="categoryForm">
                        <div class="modal-body">
                            {{-- <div class="form-group mb-3">
                                <label class="form-label">Organization ID</label>
                                <input type="number" id="org_id" name="org_id" class="form-control" required>
                            </div> --}}
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                    
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control"></textarea>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="form-label">Status</label>
                                <select id="is_active" name="is_active" class="form-select" required>
                                    <option value="">--Select Status--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                    
                            <input type="hidden" name="is_edit" id="editaction" value="0">
                    
                            <div class="d-flex justify-content-center">
                                <button type="submit" id="submitBtn" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                    
                      
                      {{-- <input type="hidden" name="is_edit" id="editaction" data-editid="" value="0"> --}}

                     
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Close</button>
                    </div>

                  </div>
                </div>
              </div>
               <!-- Category model -->
      </div>
      <!-- App container ends -->

    </div>
    <!-- Page wrapper end -->

    <!-- Custom JS files -->
    <script type="text/javascript">


//categories list
        $(function() {
            console.log($('.tickets')); // Ensure it logs the table element

            var table = $('.categories').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('categories.list') }}",
            // columns: [
            //     { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            //     {data : 'category', name: 'category'},
            //     {data: 'status', name: 'status'},
            //     {data: 'action', name: 'action', orderable: false, searchable: false},
                columns: [
       { data: 'name', name: 'name' },
      { data: 'description', name: 'description' },
    { data: 'is_active', name: 'is_active' },
    {
        data: 'id',
        name: 'id',
        orderable: false,
        searchable: false,
        render: function (data, type, row) {
            return `
                <button class="btn btn-warning btn-sm"
                        onclick="CategoryModalAction(this, ${data})"
                        data-action="edit"
                        data-name="${row.name}"
                        data-description="${row.description}"
                        data-current="${row.is_active}">
                    Edit
                </button>


            <button class="btn btn-danger btn-sm"
                        onclick="deleteCategory(${data})">
                    Delete
                </button>
            `;
        }
    }
]
            
        });  

        $('.close').click(function()
        {
          $('#myModal').hide();
        })

        $('#submitBtn').click(function(){
          var data = {
            category : $('#category').val(),
            status : $('#status').val(),
            id     : $('#editaction').data('editid') ? $('#editaction').data('editid') : null
          }

          data.id == null  ? categoryAjax('add',data) :  categoryAjax('edit',data) ;

        });

      });

      function CategoryModalAction(element, id) {
  
    $('#editaction').val(1);
    $('#editaction').data('editid', id);

    
    $('#name').val($(element).data('name'));
    $('#description').val($(element).data('description'));

    let currentStatus = $(element).data('current');
    if (currentStatus !== undefined) {
        $(`#is_active option[value="${currentStatus}"]`).prop('selected', true);
    }

   
    $('#myModal').show();
}




        function categoryAjax(type,data){

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });

            $.ajax({
            url: `category/${type}`,
            type: 'POST',
            data: JSON.stringify(data), 
            contentType: 'application/json',
            success: function(response){
              console.log('response : ',response);
              if(response.status == 'success')
              {
                $('#myModal').hide();
                alert(response.message)
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






// debugger
$('#categoryForm').on('submit', function(e) {
    e.preventDefault();
    // Retrieve the edit ID from your hidden element or any other place
    var categoryId = $('#editaction').data('editid');
    
    // Construct the update URL using the stored categoryId
    var updateUrl = '/categories/update/' + categoryId;
    
    // Optionally, if you’re using Laravel’s route helper in Blade,
    // you can set a placeholder and then replace it:
    // var updateUrl = "{{ route('categories.update', ':id') }}".replace(':id', categoryId);
    
    // Gather form data
    var formData = $(this).serialize();

    // Send the AJAX request
    $.ajax({
        url: updateUrl,
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log('Category updated successfully');
            // Optionally close the modal and refresh the category list
            $('#table').DataTable().ajax.reload(null, false);
            $('#myModal').hide();
        },
        error: function(error) {
            console.error('Error updating category:', error);
        }
    });
});


    $('#categoryForm').on('submit', function(e) {
    e.preventDefault();
    var isEditMode = $('#editaction').val() == 1;
    var categoryId = $('#editaction').data('editid');
    
    var formData = $(this).serialize(); // or collect data manually

    if (isEditMode && categoryId) {
        // Update existing record
        $.ajax({
            url: '/updateCategory',  // your update endpoint
            type: 'POST',
            data: formData + '&id=' + categoryId,
            success: function(response) {
                console.log('Category updated successfully');
                $('#myModal').css('display', 'none');

// Reload DataTable 
       $('#table').DataTable().ajax.reload(null, false);
                // Optionally close modal and refresh data
            },
            error: function(error) {
                console.error('Error updating category:', error);
            }
        });
    } else {
        // Insert new record
       
        $.ajax({
            url: "{{ route('categories.store') }}",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function (response) {
               console.log('resposne'+response)
                $('#categoryForm')[0].reset();
                // $('#categoryForm').close();

                $('#myModal').css('display', 'none');

// Reload DataTable 
       $('#table').DataTable().ajax.reload(null, false);
            },
            error: function(error) {
                console.error('Error creating category:', error);
            }
        });
    }
});

    function deleteCategory(categoryId) {
        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: `/categories/delete/${categoryId}`,
                type: 'DELETE',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function (response) {
                    alert(response.success);
                    $('#myModal').hide();
                    $('#table').DataTable().ajax.reload(null, false);
                    $('#categoryTable').DataTable().ajax.reload(); 
                },
                error: function () {
                    alert("Error deleting category!");
                }
            });
        }
    }


//stoer the categores
//         $('#categoryForm').submit(function (e) {
//         e.preventDefault();

//         $.ajax({
//             url: "{{ route('categories.store') }}",
//             type: "POST",
//             data: $(this).serialize(),
//             dataType: "json",
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             },
//             success: function (response) {
//                console.log('resposne'+response)
//                 $('#categoryForm')[0].reset();
//                 // $('#categoryForm').close();

//                 $('#myModal').css('display', 'none');

// // Reload DataTable 
//        $('#table').DataTable().ajax.reload(null, false);
//             },
//             error: function (xhr) {
//                 alert("Error: " + xhr.responseJSON.message);
//             }
//         });
//     });




    </script>



  
  </body>

</html>