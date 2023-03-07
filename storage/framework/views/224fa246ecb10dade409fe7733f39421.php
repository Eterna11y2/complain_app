
<?php $__env->startSection('content'); ?>
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
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>
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
                    <?php $__currentLoopData = $complains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                        <?php echo e($complain->details); ?>

                        </td>
                        <td ><?php echo e($complain->category->name); ?></td>
                        <td ><?php echo e($complain->subcategory->name); ?></td>
                        <td ><?php echo e($complain->state->name); ?></td>
                        <td ><?php echo e($complain->staff->name); ?></td>
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
                        <td style="text-align: center;"><?php
                        $files = customer_controller::get_complain_doc($complain->id);
                        ?>
                        <?php if($files && count($files) > 0): ?>
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(asset($file->path)); ?>" download>Document <?php echo e($loop->iteration); ?></a><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <span>No File</span>
                        <?php endif; ?>
                        </td>
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
          </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_system\resources\views/complains_listview.blade.php ENDPATH**/ ?>