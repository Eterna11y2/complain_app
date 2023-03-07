@extends('master')
@section('content')
<?php
use App\Http\Controllers\customer_controller;
?>
<div class="content-wrapper">
    <div class="content">
      <div class="row">

            <div class="col-12">
              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>Manage Complains</h2>
                </div>
                <div class="card-body pt-0 pb-5">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="responsive-data-table">
					        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                  
                    <thead>
                      <tr>
                        <th>S.NO</th>
                        <th>Complain Details</th>
                        <th >Category</th>
                        <th >SubCategory</th>
                        <th >State</th>
                        <th >Staff</th>
                        <th >Status</th>
                        <th>Documents </th>
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
                        <td >{{$complain->category->name}}</td>
                        <td >{{$complain->subcategory->name}}</td>
                        <td >{{$complain->state->name}}</td>
                        <td >{{$complain->staff->name}}</td>
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
                        <td style="text-align: center;"><?php
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
                                <a href="/complain/delete/{{$complain->id}}" onclick="return confirm('Are you sure?')">Remove</a>
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
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

@endsection