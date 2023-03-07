
<?php $__env->startSection('content'); ?>
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
              <h4 class="text-dark mb-5">Customer Registration</h4>
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
              <form action="/register" method='post'>
                <?php echo csrf_field(); ?>
                <div class="row">
                    
                  <div class="form-group col-md-12 mb-4">
                      <input type="text" class="form-control input-lg" value="<?php echo e(old('name')); ?>" name="name" id="name" aria-describedby="emailHelp" placeholder="Username">
                    </div>

                    <div class="form-group col-md-12 mb-4">
                      <input type="email" class="form-control input-lg" value="<?php echo e(old('email')); ?>" name="email" id="email" aria-describedby="nameHelp" placeholder="Email">
                    </div>

                    <div class="form-group col-md-12 mb-4">
                      <input type="text" class="form-control input-lg" value="<?php echo e(old('contact')); ?>" name="contact" id="contact" aria-describedby="nameHelp" placeholder="Contact Number">
                    </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
                  </div>

                  <div class="form-group col-md-12 ">
                    <input type="password" class="form-control input-lg" name="confirm-password" id="cpassword" placeholder="Confirm Password">
                  </div>

                  <div class="col-md-12">
                    

                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign Up</button>

                    <p>Already have an account?
                      <a class="text-blue" href="/login">Sign in</a>
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_app\resources\views/registration.blade.php ENDPATH**/ ?>