
<?php $__env->startSection('admin_content'); ?>

<div class="card card-default m-5" style='width:50%;'>
        <div class="card-header card-header-border-bottom">
            <h2>Create Staff</h2>
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
            <form class="form-pill" method="POST" action="/admin/create_staff">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Username</label>
                    <input type="texr" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="exampleFormControlInput3" placeholder="Enter Username here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Email address</label>
                    <input type="email" class="form-control" value="<?php echo e(old('email')); ?>" name="email" id="exampleFormControlInput3" placeholder="Enter Email here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="text" class="form-control" value="<?php echo e(old('contact')); ?>" name="contact" id="exampleFormControlInput3" placeholder="Enter Contact Number here">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlPassword3" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm-password" id="exampleFormControlPassword3" placeholder="ConfirmPassword">
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Submit</button>
                </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_system\resources\views/create_staff_form.blade.php ENDPATH**/ ?>