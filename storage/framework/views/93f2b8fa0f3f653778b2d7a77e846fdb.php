
<?php $__env->startSection('content'); ?>
<div class="container d-flex align-items-center justify-content-center vh-100 ">
<div class="card-body p-5">
<div class="card card-default">
			<div class="card-header card-header-border-bottom">
				<h2>Complain Form</h2>
			</div>
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
			<div class="card-body">
				<form class="form-pill" method="POST" action='/create_complain' enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Main Category</label>
						        <select class="form-control" id="maincategory" name="maincategory">
                                    <option style = "display: none;" disabled selected>Select Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect4">Select Subcategory</label>
                                    <select class="form-control" id="subcategory-select" name="subcategory-select">
                                        <option style = "display: none;" disabled selected>Select Subcategory</option>
                                    </select>
                                </div>
                            </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">State</label>
						        <select class="form-control" name="state-select" id="state-select">
                                    <option style = "display: none;" disabled selected>Select State</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($state->id); ?>"><?php echo e($state->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
						<label for="exampleFormControlInput3">Complain Details</label>
						<textarea class="form-control rounded" value="<?php echo e(old('complainTextarea')); ?>" name="complainTextarea" id="complainTextarea" rows="5"></textarea>
					</div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload File OR Image <small>(If any)</small></label>
                        <input type="file" class="form-control-file" name="images[]" id="file" multiple>
                    </div>
                    <div class="form-group my-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-pill my-4">Submit</button>
					</div>
				</form>
			</div>
		</div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#maincategory').on('change', function() {
            var categoryID = $(this).val();
            $.ajax({
            url: '/admin/get_subcat_ajax/'+categoryID,
            type: 'GET',
            success: function(data) {
                $('#subcategory-select').empty();
                $('#subcategory-select').append('<option style = "display: none;" value="" selected disabled>Select Subcategory</option>');
                data.forEach(function(subcategory) {
                    $('#subcategory-select').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
                });
            },
            error: function() {
                alert('Unable to fetch OR there\'s not sub category of this category');
            }
        });
        
        });

    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\workspace\complain_app\resources\views/complain_form.blade.php ENDPATH**/ ?>