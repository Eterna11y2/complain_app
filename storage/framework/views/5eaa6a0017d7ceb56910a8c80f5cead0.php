<?php
use Illuminate\Http\Request;
?>
;
<?php $__env->startSection(str_contains(url()->current(), 'admin') ? 'admin_content' : 'content'); ?>;

<div class="content-wrapper">
            <div class="content">
<div class="row">
	<div class="col-lg-6">
		<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Update Profile</h2>
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
				<form action="/update-profile" method="Post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Username</label>
                    <input type="texr" class="form-control" value="<?php echo e($user->name); ?>" name="user-name" id="exampleFormControlInput3" placeholder="Update Username here">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput3">Contact Number</label>
                    <input type="text" class="form-control" value="<?php echo e($user->contact); ?>" name="user-contact" id="exampleFormControlInput3" placeholder="Update Contact Number here">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlPassword3">Password</label>
                    <input type="password" class="form-control" name="user-password" id="exampleFormControlPassword3" placeholder="Update Password">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Address</label>
                    <input type="text" class="form-control" value="<?php echo e($user->address); ?>" name="user-address" id="exampleFormControlPassword3" placeholder="UpdateAddress">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlPassword3">Upload Profile Image</label>
                    <input type="file" class="form-control" name="Image" id="exampleFormControlPassword3" >
                </div>
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Update</button>
                </div>
				</form>
			</div>
		</div>

    </div>
</div>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(str_contains(url()->current(), 'admin') ? 'admin_master' : 'master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_app\resources\views/updateprofile.blade.php ENDPATH**/ ?>