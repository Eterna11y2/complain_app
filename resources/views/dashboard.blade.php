@extends('master')
@section('content')
<?php
use App\Http\Controllers\customer_controller;
$new_complain_count = customer_controller::get_complains_count(0);
$pending_complain_count = customer_controller::get_complains_count(1);
$completed_complain_count = customer_controller::get_complains_count(2);
$total_complain_count = customer_controller::get_complains_count(3);
?>
     <!-- ====================================
          ——— CONTENT WRAPPER
          ===================================== -->
          <div class="content-wrapper">
            <div class="content">
                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                        <h2 class="mb-1">{{$total_complain_count}}</h2>
                          <p>Total Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="barChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                        <h2 class="mb-1">{{$new_complain_count}}</h2>
                          <p>New Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini  mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">{{$pending_complain_count}}</h2>
                          <p>In Progress Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="dual-line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1">{{$completed_complain_count}}</h2>
                          <p>Completed Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="area-chart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>


		<div class="row">
			<div class="col-12">
				
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none recent-orders" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>Recent Complains</h2>
                      
                    </div>
                    <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                      <thead>
                        <tr>
                          <th>S.NO</th>
                          <th>Complain Details</th>
                          <th class="d-none d-lg-table-cell">Category</th>
                          <th class="d-none d-lg-table-cell">SubCategory</th>
                          <th class="d-none d-lg-table-cell">State</th>
                          <th class="d-none d-lg-table-cell">Staff</th>
                          <th>Complain Status</th>
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

	






      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
@endsection