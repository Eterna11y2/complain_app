
<?php $__env->startSection('admin_content'); ?>
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
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                          <a class="text-dark" href=""><?php echo e($user->email); ?></a>
                        </td>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->contact); ?></td>
                        <?php if($user->type == 1): ?>
                        <td>
                          <span class="badge badge-danger">Administrator</span>
                        </td>
                        <?php elseif($user->type == 2): ?>
                        <td>
                          <span class="badge badge-warning">Staff</span>
                        </td>
                        <?php else: ?>
                        <td>
                          <span class="badge badge-success">Customer</span>
                        </td>
                        <?php endif; ?>
                        
                        <!-- class = "text-right" -->
                        <td>
                          <div class="dropdown show d-inline-block widget-dropdown">
                            <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                              id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" data-display="static"></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                              <li class="dropdown-item">
                                <a href="/admin/edit_user/<?php echo e($user->id); ?>">Edit</a>
                              </li>
                              <li class="dropdown-item">
                                <a href="/admin/delete_user/<?php echo e($user->id); ?>">Delete</a>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_system\resources\views/user_management.blade.php ENDPATH**/ ?>