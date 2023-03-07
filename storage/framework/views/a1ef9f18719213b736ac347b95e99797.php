
<?php $__env->startSection('admin_content'); ?>
<div class="row">
            <div class="col-12">

              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>User Management</h2>
                  <div class="date-range-report ">
                    <!-- <span></span> -->
                  </div>
                </div>
                <div class="card-body pt-0 pb-5">
                  <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Email</th>
                        <th class="d-none d-lg-table-cell">Name</th>
                        <th class="d-none d-lg-table-cell">Contact</th>
                        <th class="d-none d-lg-table-cell">Role</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td>
                          <a class="text-dark" href=""><?php echo e($user->email); ?></a>
                        </td>
                        <td class="d-none d-lg-table-cell"><?php echo e($user->name); ?></td>
                        <td class="d-none d-lg-table-cell"><?php echo e($user->contact); ?></td>
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
                        <td class="d-none d-lg-table-cell">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\workspace\complain_app\resources\views/user_management.blade.php ENDPATH**/ ?>