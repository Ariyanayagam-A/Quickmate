@extends('layouts.adminlayout.app') @section('title', 'Dashboard') @section('content')
<!-- App body starts -->
<div class="app-body">
  <!-- Container starts -->
  <div class="container">
    <!-- Row start -->
    <div class="row">
      <div class="col-12 col-xl-6">
        <!-- Breadcrumb start -->
        <div class="row">
          <div class="col-12 col-xl-6">
            <!-- Breadcrumb start -->
            <ol class="breadcrumb m-3">
              <li class="breadcrumb-item "> Category </li>
            </ol>
            <!-- Breadcrumb end -->
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
    <!-- Row start -->
    <div class="row">
      <div class="col-12 col-xl-2">
        <div>
          <a href="#" onclick="CategoryModalAction(this,null)" data-action="add">
            <button type="button" class="btn btn-info" fdprocessedid="im3l2s"> Add Category </button>
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
                  <th>Category</th>
                  <th>Description</th>
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

<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Category</h4>
        <button type="button" class="btn-close close" data-bs-dismiss="modal"></button>
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
<!-- App container ends -->
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
      columns: [{
        data: 'name',
        name: 'name'
      }, {
        data: 'description',
        name: 'description'
      }, {
        data: 'status',
        name: 'status'
      }, {
        data: 'id',
        name: 'id',
        orderable: false,
        searchable: false,
        render: function(data, type, row) {
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
      }]
    });
    $('.close').click(function() {
      $('#myModal').hide();
    })
    $('#submitBtn').click(function() {
      var data = {
        category: $('#category').val(),
        status: $('#status').val(),
        id: $('#editaction').data('editid') ? $('#editaction').data('editid') : null
      }
      data.id == null ? categoryAjax('add', data) : categoryAjax('edit', data);
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

  function categoryAjax(type, data) {
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
      success: function(response) {
        console.log('response : ', response);
        if (response.status == 'success') {
          $('#myModal').hide();
          alert(response.message)
          setTimeout(() => $('#table').DataTable().ajax.reload(), 1000);
        } else {
          alert('Something went wrong');
        }
      },
      error: function(error) {
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
var updateUrl = "{{ route('categories.update', ':id') }}".replace(':id', categoryId);
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
        url: '/updateCategory', // your update endpoint
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
        success: function(response) {
          console.log('resposne' + response)
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
        url:"{{ route('categories.delete', ':id') }}".replace(':id', categoryId),
        type: 'DELETE',
        data: {
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          alert(response.success);
          $('#myModal').hide();
          $('#table').DataTable().ajax.reload(null, false);
          $('#categoryTable').DataTable().ajax.reload();
        },
        error: function() {
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
</script> @endsection