@extends('admin_master')
@section('admin_content')
<div class="content-wrapper">
    <div class="content">
<!-- modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modal-contact">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add a form to edit the category -->
        <form method="POST" id="UpdateSubcat">
          @csrf
          <input type="hidden" name="id" id="editStaffmapping">
          <div class="form-group">
            <label for="editCategoryName">Name:</label>
            <input type="text" class="form-control" disabled id="staff_name">
          </div>
          <div class="form-group">
          <select class="form-control" name="category-dropdown" id="category-dropdown" aria-label=".form-select-lg example">
          </select>
        </div>
          <div id="message"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitedit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->
<div class="row">
            <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>Manage User Category</h2>
                  <div class="">
                  @if($users->count() > 0)
                  <div class="col-sm-12 col-md-12 text-center">
                        <form action = "/admin/create_mapping" method ="POST" class="form-inline">
                            @csrf
                        <div class="form-group">
                        <select class="form-control mx-2" name = "user-select" aria-label=".form-select-lg example">
                            <option style = "display: none;" disabled selected>Select User</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                        <select class="form-control mx-2" name = "category-select" aria-label=".form-select-lg example">
                            <option style = "display: none;" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                        </form>
                  </div>
                  @endif
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <!--<form class="form-inline">
                        <div class="form-group">
                        <label for="editCategoryName">Select Category: </label>
                        <select class="form-control mx-2" id="category-search" name="category-search" aria-label=".form-select-lg example">
                            <option style = "display: none;" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        </div>
                        <button type="button" id="search-category" class="btn btn-success"><i class="fa fa-search" style="font-size : 15px;" aria-hidden="true"></i></button>
                    </form>-->
                  </div>
                <div class="card-body pt-0 pb-5 col-md-12">
                  <br>
                <div class="responsive-data-table">
					        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                     <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Staff Member Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
            
                    @foreach ($staffmappings as $staffmapping)
                    <tr>    

                        <td>{{$loop->iteration}}</td>
                        <td>{{ $staffmapping->user->name }}
                            <br>
                            <small>
                            <span class="badge badge-primary"> {{ $staffmapping->category->name }} </span>
                            </small>
                        </td>
                        <td>
                        <!-- Add edit and delete buttons with appropriate links -->
                        <!-- <a href="{{ url('/categories/'.$category->id.'/edit') }}">Edit</a> -->
                        <button class="btn btn-primary editCategory"  data-toggle="modal" data-target="#modal-contact" data-id="{{ $staffmapping->id }}" data-staffname="{{ $staffmapping->user->name }}" data-catid="{{ $staffmapping->category_id }}">Edit</button>
                        <a href="/admin/delete_mapping/{{$staffmapping->id}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                        

                        </td>
                    </tr>
                    @endforeach
                   
                    </tbody>
                  </table>
                </div>
                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        $(document).on('click', '#search-category', function() {
        var categoryId = $("#category-search").val();
        $.ajax({
            url: "/admin/get_mapping_category/"+categoryId,
            type: 'GET',
            success: function(data) {
                $("#table-body").html(data);
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })
        $(document).on('click', '#submitedit', function() {
          var form = $('#UpdateSubcat').serialize();
          var editUrl = '/admin/edit_staff_mapping'
        $.ajax({
            url: editUrl,
            type: 'POST',
            data:form,
            success: function(data) {
              
              if(data.errors){
                    var errors = data.errors;
                    var html = '<div class="alert alert-danger"><ul>';              
                  
                    html += '<li>' + errors + '</li>';
                  html += "</ul></div>";
                  $("#message").html(html);
              }else{
                if(data == 'Success')
                {
                    $('#message').html('<div class="alert alert-success" role="alert">Category Mapping Updated!</div>');  
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
                else{

                }
              }
            },
            error: function() {
            alert('Error getting Subcategory data');
            }
        });

        })
        
        $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('catid');
        var mapId = $(this).data('id');
        var staff_name = $(this).data('staffname');
        var editUrl = '/admin/get_subcategory_ajax/' + categoryId;
        $.ajax({
            url: editUrl,
            type: 'GET',
            success: function(data) {
            // Populate the modal form with the category data
            $('#editStaffmapping').val(mapId);
            $('#staff_name').val(staff_name);            
            var select = $('#category-dropdown');
            select.empty();
            //select.append($('<option></option>').attr('value', data.subcategory.category.name.id).text(data.subcategory.category.name).prop('selected', true).prop('disabled', true));
            selected = "";
            $.each(data.categories, function(index, item) {
              if(categoryId == item.id){selected = "selected"}else{selected = "";}
            select.append($('<option '+selected+'></option>').attr('value', item.id).text(item.name));
            });
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })


    })
</script>
@endsection