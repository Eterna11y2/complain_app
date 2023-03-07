@extends('admin_master')
@section('admin_content')
<div class="content-wrapper">
    <div class="content">
      <div class="row">
            <div class="col-12">

              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>User Management <a href="/admin/staff"><button class="btn btn-success mx-2">Add Staff Member</button></a>
</h2>
                  
                  <div class="date-range-report ">
                    <!-- <span></span> -->
                  </div>
                </div>
                <div class="card-body pt-0 pb-5">
                <div class="responsive-data-table">
					        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          <a class="text-dark" href="">{{$user->email}}</a>
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->contact}}</td>
                        @if($user->type == 1)
                        <td>
                          <span class="badge badge-danger">Administrator</span>
                        </td>
                        @elseif($user->type == 2)
                        <td>
                          <span class="badge badge-warning">Staff</span>
                        </td>
                        @else
                        <td>
                          <span class="badge badge-success">Customer</span>
                        </td>
                        @endif
                        
                        <!-- class = "text-right" -->
                        <td>
                          <div class="dropdown show d-inline-block widget-dropdown">
                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                              id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" data-display="static"></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                              <li class="dropdown-item">
                                <a href="/admin/edit_user/{{$user->id}}">Edit</a>
                              </li>
                              <li class="dropdown-item">
                                <a href="/admin/delete_user/{{$user->id}}">Delete</a>
                              </li>
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


@endsection