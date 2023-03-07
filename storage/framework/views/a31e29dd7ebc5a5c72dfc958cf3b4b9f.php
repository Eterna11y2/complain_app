
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
        <form method="POST" id="UpdateCatName">
          <?php echo csrf_field(); ?>
          <input type="hidden" name="id" id="editCategoryId">
          <div class="form-group">
            <label for="editCategoryName">Name:</label>
            <input type="text" class="form-control" id="editCategoryName" name="name">
          </div>
          <div id="message"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editCategoryButton">Save changes</button>
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
                  <h2>Manage Category</h2>
                  <div class="">
                  <div class="col-sm-12 col-md-12 text-center">
                        <form action = "/admin/add_category" method ="POST" class="form-inline">
                            <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control" name = "category-name"id="exampleInputName2" placeholder="Add new category here!">
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Add</button>
                        </form>
                  </div>
                </div>
                <div class="card-body pt-0 pb-5 col-md-12">
                    
                <table id="expendable-data-table" class="table display nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Category Name</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                       <td><?php echo e($loop->iteration); ?></td>
                        <td ><?php echo e($category->name); ?></td>
                        <td>
                        <!-- Add edit and delete buttons with appropriate links -->
                        <!-- <a href="<?php echo e(url('/categories/'.$category->id.'/edit')); ?>">Edit</a> -->
                        <button class="btn btn-primary editCategory"  data-toggle="modal" data-target="#modal-contact" data-id="<?php echo e($category->id); ?>">Edit</button>
                        <a href="/admin/delete_cat/<?php echo e($category->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                        
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- <tr>
                    <td>24541</td>
                    <td>
                        <a class="text-dark" href=""> Coach Swagger</a>
                    </td>
                    <td class="text-right">
                        <div class="dropdown show d-inline-block widget-dropdown">
                        <a class="dropdown-toggle icon-burger-mini" href="" role="button"
                            id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-display="static"></a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                            <li class="dropdown-item">
                            <a href="#">View</a>
                            </li>
                            <li class="dropdown-item">
                            <a href="#">Remove</a>
                            </li>
                        </ul>
                        </div>
                    </td>
                    <td>
                    </td>
                    </tr> -->
                      
                    </tbody>
                  </table>
                
                
                </div>
                
              </div>

            </div>
          </div>
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        
        $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('id');
        var editUrl = '/admin/get_category/' + categoryId;
        $.ajax({
            url: editUrl,
            type: 'GET',
            success: function(data) {
            // Populate the modal form with the category data
            $('#editCategoryId').val(data.id);
            $('#editCategoryName').val(data.name);            
            
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })

        $(document).on('click', '#editCategoryButton', function() {
        // var categoryId = $(this).data('id');
        var form = $('#UpdateCatName').serialize();
        var editUrl = '/admin/edit_category'
        $.ajax({
            url: editUrl,
            type: 'POST',
            data:form,
            success: function(data) {
                
                if(data == 'Success')
                {
                    $('#message').html('<div class="alert alert-success" role="alert">Category Updated!</div>');  
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
                else{

                }
            
            },
            error: function() {
            alert('Error getting category data');
            }
        });
        })

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\workspace\complain_app\resources\views/category.blade.php ENDPATH**/ ?>