
<?php $__env->startSection('admin_content'); ?>
<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-contact">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add a form to edit the category -->
        <form method="POST" id="UpdateSubcat">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" id="editCategoryId">
          <div class="form-group">
            <label for="editCategoryName">Name:</label>
            <input type="text" class="form-control" id="editCategoryName" name="name">
          </div>
          <div class="form-group">
          <select class="form-control" name="category-dropdown" id="category-dropdown" aria-label=".form-select-lg example">
          </select>
        </div>
          <div id="message"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitedit">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->
<div class="row">
            <div class="col-12">
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
              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>Manage Sub-Category</h2>
                  <div class="">
                  <div class="col-sm-12 col-md-12 text-center">
                        <form action = "/admin/add_subcategory" method ="POST" class="form-inline">
                            <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo e(old('category-name')); ?>" name = "category-name"id="exampleInputName2" placeholder="Add new category here!">
                        </div>
                        <div class="form-group">
                        <select class="form-control mx-2" name = "category-select" aria-label=".form-select-lg example">
                            <option style = "display: none;" disabled selected>Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                        </form>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <form class="form-inline">
                        <div class="form-group">
                        <label for="editCategoryName">Select Category: </label>
                        <select class="form-control mx-2" id="category-search" name="category-search" aria-label=".form-select-lg example">
                            <option style = "display: none;" disabled selected>Select Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>
                        <button type="button" id="search-category" class="btn btn-success"><i class="fa fa-search" style="font-size : 15px;" aria-hidden="true"></i></button>
                    </form>
                  </div>
                <div class="card-body pt-0 pb-5 col-md-12">
                  <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Sub Category Name</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
            
                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>    

                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($category->name); ?>

                            <br>
                            <small>
                            <span class="badge badge-primary"> <?php echo e($category->category->name); ?> </span>
                            </small>
                        </td>
                        <td>
                        <!-- Add edit and delete buttons with appropriate links -->
                        <!-- <a href="<?php echo e(url('/categories/'.$category->id.'/edit')); ?>">Edit</a> -->
                        <button class="btn btn-primary editCategory"  data-toggle="modal" data-target="#modal-contact" data-id="<?php echo e($category->id); ?>">Edit</button>
                        <a href="/admin/delete_subcat/<?php echo e($category->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                        

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        $(document).on('click', '#search-category', function() {
        var categoryId = $("#category-search").val();
        $.ajax({
            url: "/admin/get_sub_category/"+categoryId,
            type: 'GET',
            success: function(data) {
                $("#table-body").html(data);
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })
        $(document).on('click', '#submitedit', function() {
          var form = $('#UpdateSubcat').serialize();
          alert(form);

        })
        
        $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('id');
        var editUrl = '/admin/get_subcategory_ajax/' + categoryId;
        $.ajax({
            url: editUrl,
            type: 'GET',
            success: function(data) {
            // Populate the modal form with the category data
            $('#editCategoryId').val(data.subcategory.id);
            $('#editCategoryName').val(data.subcategory.name);            
            var select = $('#category-dropdown');
            select.empty();
            select.append($('<option></option>').attr('value', data.subcategory.category.name.id).text(data.subcategory.category.name).prop('selected', true).prop('disabled', true));
            $.each(data.categories, function(index, item) {
            select.append($('<option></option>').attr('value', item.id).text(item.name));
            });
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })


    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\workspace\complain_app\resources\views/subcategory.blade.php ENDPATH**/ ?>