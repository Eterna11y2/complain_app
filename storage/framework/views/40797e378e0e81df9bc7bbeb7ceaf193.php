
<?php $__env->startSection('admin_content'); ?>

<div class="card card-default m-5" style='width:50%;'>
        <div class="card-header card-header-border-bottom">
            <h2>Edit User</h2>
        </div>

        <div class="card-body">

              <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
              <form class="form-pill" action="/admin/edit_user" method="POST">
                <?php echo csrf_field(); ?>
                  <input type="text" name = "id" id="id"  value= '<?php echo e($user->id); ?>' hidden  >

                  <div class="form-group ">
                    <label for="exampleFormControlPassword3">Name</label> 
                    <input type="text" class="form-control input-lg" value='<?php echo e($user->name); ?>' name="name" >
                  </div>
                  
                  <div class="form-group ">
                  <label for="exampleFormControlInput3">Email address</label>
                    <input type="text" class="form-control input-lg" value= '<?php echo e($user->email); ?>' disabled  >
                  </div>
                  
                  <div class="form-group ">
                  <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="password" class="form-control input-lg" name = "password" id="email" aria-describedby="emailHelp" placeholder="Enter New Password">
                  </div>

                  <div class="form-group ">
                  <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control input-lg" name = "confirm-password" id="password" placeholder="Confirm Password">
                  </div>

                  
                  <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Update</button>
                </div>

                    
                 
              </form>
              </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_system\resources\views/edit_user.blade.php ENDPATH**/ ?>