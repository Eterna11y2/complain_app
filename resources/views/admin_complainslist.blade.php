@extends('admin_master')
@section('admin_content')
<?php

use App\Http\Controllers\customer_controller;

?>
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
          <input type="hidden" name="id" id="editCategoryId">
          <div class="form-group">
            <label for="editCategoryName">Category:</label>
            <select class="form-control" id="maincategory" name="maincategory">
                <option style = "display: none;" disabled selected>Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
          </div>
          <div class="form-group">
                <label for="exampleFormControlSelect4">Select Subcategory</label>
                <select class="form-control" id="subcategory-select" name="subcategory-select">
                    <option style = "display: none;" disabled selected>Select Subcategory</option>
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
  <div class="content-wrapper">
      <div class="content">
          <div class="row">
            <div class="col-md-12">

              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>Manage Complains</h2>
                  
                </div>
                <div class="card-body pt-0 pb-5">
                <div class="responsive-data-table">
					        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                  <thead>
                      <tr>
                        <th>S.NO</th>
                        <th>Complain Details</th>
                        <th class="d-none d-lg-table-cell">Category</th>
                        <th class="d-none d-lg-table-cell">SubCategory</th>
                        <th class="d-none d-lg-table-cell">State</th>
                        <th class="d-none d-lg-table-cell">Customer</th>
                        <th class="d-none d-lg-table-cell">Staff Name</th>
                        <th>Status</th>
                        <th>Documents</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($complains as $complain)
                     <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                        {{$complain->details}}
                        </td>
                        <td class="d-none d-lg-table-cell">{{$complain->category->name}}</td>
                        <td class="d-none d-lg-table-cell">{{$complain->subcategory->name}}</td>
                        <td class="d-none d-lg-table-cell">{{$complain->state->name}}</td>
                        <td class="d-none d-lg-table-cell">{{$complain->user->name}}</td>
                        <td class="d-none d-lg-table-cell">{{$complain->staff->name}}</td>
                        @if($complain->status == -1)
                        <td>
                            <span class="badge badge-danger">Cancelled</span>
                        </td>
                        @elseif($complain->status == 0)
                        <td>
                            <span class="badge badge-danger">New</span>
                        </td>
                        @elseif($complain->status == 1)
                        <td>
                            <span class="badge badge-warning">In progess</span>
                        </td>
                        @else
                        <td>
                            <span class="badge badge-success">Completed</span>
                        </td>
                        @endif
                        <td><?php
                        $files = customer_controller::get_complain_doc($complain->id);
                        ?>
                        @if($files && count($files) > 0)
                            @foreach($files as $file)
                                <a href="{{ asset($file->path) }}" download>Document {{$loop->iteration}}</a><br>
                            @endforeach
                        @else
                            <span>No File</span>
                        @endif
                      </td>
                        <td class="text-right">
                          <div class="dropdown show d-inline-block widget-dropdown">
                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                              id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" data-display="static"></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">
                              <li class="dropdown-item">
                                @if($complain->status == 0)
                                <a href="/complain/update_status/{{$complain->id}}" onclick="return confirm('Are you sure?')">Initiate Complain</a>
                                @elseif($complain->status == 1)
                                <a href="/complain/update_status/{{$complain->id}}" onclick="return confirm('Are you sure?')">Mark as Completed</a>
                                @elseif($complain->status == 2)
                                <a >Completed</a>
                                @endif
                              </li>
                              @if($complain->status == 0)<li class="dropdown-item">
                                <button class="editCategory" id='editbtnID'  data-toggle="modal" data-target="#modal-contact" data-id="{{ $complain->id }}">Edit</button>
                              </li>
                              @endif
                            </ul>
                          </div>
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
      $(document).on('click', '#submitedit', function() {
          var form = $('#UpdateSubcat').serialize();
          url = '/admin/edit_complain';
          $.ajax({
            url: url,
            method: 'POST',
            data: form,
            success: function(response) {
              if(response.errors){
                    var errors = response.errors;
                    var html = '<div class="alert alert-danger"><ul>';              
                  
                    html += '<li>' + errors + '</li>';
                  html += "</ul></div>";
                  $("#message").html(html);
              }else{
              if(response == 'Success')
                {
                    $('#message').html('<div class="alert alert-success" role="alert">Category Updated!</div>');  
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
              }
            },
            error: function(xhr, status, error) {
              // handle error response
              alert(xhr.responseText);
            }
          });


        })
      $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('id');
        $('#editCategoryId').val(categoryId);
        
      });
      $('#maincategory').on('change', function() {
            var categoryID = $(this).val();
            $.ajax({
            url: '/admin/get_subcat_ajax/'+categoryID,
            type: 'GET',
            success: function(data) {
                $('#subcategory-select').empty();
                $('#subcategory-select').append('<option style = "display: none;" value="" selected disabled>Select Subcategory</option>');
                data.forEach(function(subcategory) {
                    $('#subcategory-select').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            },
            error: function() {
                alert('Unable to fetch OR there\'s not sub category of this category');
            }
        });
        
        });
      
        
       

    })
</script>

@endsection