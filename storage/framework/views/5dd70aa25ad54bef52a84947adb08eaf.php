
<?php $__env->startSection('admin_content'); ?>

<div class="container d-flex align-items-center justify-content-center vh-100">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="/index.html">
                <img src="<?php echo e(asset('assets/img/login-image.png')); ?>"  width="50" height="53" alt="">  
                  <span class="brand-name">CMS</span>
                </a>
              </div>
            </div>

            <div class="card-body p-5">
              <h4 class="text-dark mb-5">Password Rest</h4>
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
              <form action="/admin/edit_user" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <input type="text" name = "id" id="id"  value= '<?php echo e($user->id); ?>' hidden  >

                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" value= '<?php echo e($user->name); ?>' disabled  >
                  </div>
                  
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" class="form-control input-lg" value= '<?php echo e($user->email); ?>' disabled  >
                  </div>
                  
                  <div class="form-group col-md-12 mb-4">
                    <input type="password" class="form-control input-lg" name = "password" id="email" aria-describedby="emailHelp" placeholder="Enter New Password">
                  </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name = "confirm-password" id="password" placeholder="Confirm Password">
                  </div>

                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        
                      </div>

                    </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Update</button>

                    <p> Update User Password 
                      <a ></a>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\workspace\complain_app\resources\views/edit_user.blade.php ENDPATH**/ ?>