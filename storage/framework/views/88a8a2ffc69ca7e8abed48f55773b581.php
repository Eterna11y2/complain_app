
<?php $__env->startSection('content'); ?>
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
                        <h2 class="mb-1"><?php echo e($total_complain_count); ?></h2>
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
                        <h2 class="mb-1"><?php echo e($new_complain_count); ?></h2>
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
                          <h2 class="mb-1"><?php echo e($pending_complain_count); ?></h2>
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
                          <h2 class="mb-1"><?php echo e($completed_complain_count); ?></h2>
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
                      <?php $__currentLoopData = $complains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                          <?php echo e($complain->details); ?>

                          </td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->category->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->subcategory->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->state->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->staff->name); ?></td>
                          <?php if($complain->status == -1): ?>
                          <td>
                              <span class="badge badge-danger">Cancelled</span>
                          </td>
                          <?php elseif($complain->status == 0): ?>
                          <td>
                              <span class="badge badge-danger">New</span>
                          </td>
                          <?php elseif($complain->status == 1): ?>
                          <td>
                              <span class="badge badge-warning">In progess</span>
                          </td>
                          <?php else: ?>
                          <td>
                              <span class="badge badge-success">Completed</span>
                          </td>
                          <?php endif; ?>
                          <td class="text-right">
                            <div class="dropdown show d-inline-block widget-dropdown">
                              <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-display="static"></a>
                              <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">

                                <li class="dropdown-item">
                                  <a href="/complain/delete/<?php echo e($complain->id); ?>" onclick="return confirm('Are you sure?')">Remove</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                      </tr>
                        
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        

                      </tbody>
                    </table>
                    </div>
                  </div>

			</div>
		</div>

	






      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_app\resources\views/dashboard.blade.php ENDPATH**/ ?>