
<?php $__env->startSection('admin_content'); ?>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-contact">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit State</h5>
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
<div class="content-wrapper">
    <div class="content">
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
                  <h2>State Management</h2>
                  <div class="">
                  <div class="col-sm-12 col-md-12 text-center">
                        <form action = "/admin/add_state" method ="POST" class="form-inline">
                            <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="text" value="<?php echo e(old('name')); ?>" class="form-control" name="name" id="exampleInputName2" placeholder="Add new state here!">
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Add</button>
                        </form>
                  </div>
                </div>
                <div class="card-body pt-0 pb-5 col-md-12">
                    <br>
                <div class="responsive-data-table">
					        <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>State</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td ><?php echo e($state->name); ?></td>
                        <td>
                        <!-- Add edit and delete buttons with appropriate links -->
                        <!-- <a href="<?php echo e(url('/categories/'.$state->id.'/edit')); ?>">Edit</a> -->
                        <button class="btn btn-primary editCategory"  data-toggle="modal" data-target="#modal-contact" data-name="<?php echo e($state->name); ?>"data-id="<?php echo e($state->id); ?>">Edit</button>
                        <a href="/admin/delete_state/<?php echo e($state->id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>                        
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
          
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        
        $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('id');
        var categoryName = $(this).data('name');
        $('#editCategoryId').val(categoryId);
        $('#editCategoryName').val(categoryName);     
        
        })

        $(document).on('click', '#editCategoryButton', function() {
        var form = $('#UpdateCatName').serialize();
        var editUrl = '/admin/edit_state'
        $.ajax({
            url: editUrl,
            type: 'POST',
            data:form,
            success: function(data) {
              if(data.errors){
                    var errors = data.errors;
                    var html = '<div class="alert alert-danger"><ul>';              
                  $.each(errors, function(field, messages) {
                      var errorHtml = '';
                      $.each(messages, function(index, message) {
                          html += '<li>' + message + '</li>';
                      });
                  });
                  html += "</ul></div>";
                  $("#message").html(html);
              }else{
                if(data == 'Success')
                {
                    $('#message').html('<div class="alert alert-success" role="alert">State Updated!</div>');  
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
                else{

                }
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
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_app\resources\views/state.blade.php ENDPATH**/ ?>