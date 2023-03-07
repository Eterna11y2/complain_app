
<?php $__env->startSection('admin_content'); ?>
<?php
use App\Http\Controllers\admin_controller;
$new_complain_count = admin_controller::get_complains_count(0);
$pending_complain_count = admin_controller::get_complains_count(1);
$completed_complain_count = admin_controller::get_complains_count(2);
$total_complain_count = admin_controller::get_complains_count(3);
?>
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
            <label for="editCategoryName">Category:</label>
            <select class="form-control" id="maincategory" name="maincategory">
                <option style = "display: none;" disabled selected>Select Category</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group">
                <label for="exampleFormControlSelect4">Select Subcategory</label>
                <select class="form-control" id="subcategory-select" name="subcategory-select">
                    <option style = "display: none;" disabled selected>Select Subcategory</option>
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
     <!-- ====================================
          ——— CONTENT WRAPPER
          ===================================== -->
          <div class="content-wrapper">
            <div class="content">
                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                        <h2 class="mb-1"><?php echo e($total_complain_count); ?></h2>
                          <p>Total Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="barChart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                        <h2 class="mb-1"><?php echo e($new_complain_count); ?></h2>
                          <p>New Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini  mb-4">
                        <div class="card-body">
                          <h2 class="mb-1"><?php echo e($pending_complain_count); ?></h2>
                          <p>In Progress Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="dual-line"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-mini mb-4">
                        <div class="card-body">
                          <h2 class="mb-1"><?php echo e($completed_complain_count); ?></h2>
                          <p>Completed Complains</p>
                          <div class="chartjs-wrapper">
                            <canvas id="area-chart"></canvas>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>


		<div class="row">
			<div class="col-12">
				
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none recent-orders" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>Recent Complains</h2>
                     
                    </div>
                    <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                      <thead>
                        <tr>
                          <th>S.NO</th>
                          <th>Complain Details</th>
                          <th class="d-none d-lg-table-cell">Category</th>
                          <th class="d-none d-lg-table-cell">SubCategory</th>
                          <th class="d-none d-lg-table-cell">State</th>
                          <th class="d-none d-lg-table-cell">Staff</th>
                          <th>Complain Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $complains; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complain): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                          <?php echo e($complain->details); ?>

                          </td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->category->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->subcategory->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->state->name); ?></td>
                          <td class="d-none d-lg-table-cell"><?php echo e($complain->staff->name); ?></td>
                          <?php if($complain->status == -1): ?>
                          <td>
                              <span class="badge badge-danger">Cancelled</span>
                          </td>
                          <?php elseif($complain->status == 0): ?>
                          <td>
                              <span class="badge badge-danger">New</span>
                          </td>
                          <?php elseif($complain->status == 1): ?>
                          <td>
                              <span class="badge badge-warning">In progess</span>
                          </td>
                          <?php else: ?>
                          <td>
                              <span class="badge badge-success">Completed</span>
                          </td>
                          <?php endif; ?>
                          <td class="text-right">
                          <div class="dropdown show d-inline-block widget-dropdown">
                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                              id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false" data-display="static"></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">
                              <li class="dropdown-item">
                                <?php if($complain->status == 0): ?>
                                <a href="/complain/update_status/<?php echo e($complain->id); ?>" onclick="return confirm('Are you sure?')">Initiate Complain</a>
                                <?php elseif($complain->status == 1): ?>
                                <a href="/complain/update_status/<?php echo e($complain->id); ?>" onclick="return confirm('Are you sure?')">Mark as Completed</a>
                                <?php elseif($complain->status == 2): ?>
                                <a >Completed</a>
                                <?php endif; ?>
                              </li>
                              <?php if($complain->status == 0): ?><li class="dropdown-item">
                                <button class="editCategory" id='editbtnID'  data-toggle="modal" data-target="#modal-contact" data-id="<?php echo e($complain->id); ?>">Edit</button>
                              </li>
                              <?php endif; ?>
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

	






      </div> <!-- End Content -->
    </div> <!-- End Content Wrapper -->

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
      $(document).on('click', '#submitedit', function() {
          var form = $('#UpdateSubcat').serialize();
          url = '/admin/edit_complain';
          $.ajax({
            url: url,
            method: 'POST',
            data: form,
            success: function(response) {
              if(response.errors){
                    var errors = response.errors;
                    var html = '<div class="alert alert-danger"><ul>';              
                  
                    html += '<li>' + errors + '</li>';
                  html += "</ul></div>";
                  $("#message").html(html);
              }else{
              if(response == 'Success')
                {
                    $('#message').html('<div class="alert alert-success" role="alert">Category Updated!</div>');  
                    window.setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
              }
            },
            error: function(xhr, status, error) {
              // handle error response
              alert(xhr.responseText);
            }
          });


        })
      $(document).on('click', '.editCategory', function() {
        var categoryId = $(this).data('id');
        $('#editCategoryId').val(categoryId);
        
      });
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
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\complain_system\resources\views/admin_dashboard.blade.php ENDPATH**/ ?>