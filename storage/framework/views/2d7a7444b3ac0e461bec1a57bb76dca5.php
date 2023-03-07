<?php 
use Illuminate\Support\Facades\Auth;
$user = Auth::user(); // Get the authenticated user
$name = $user->name;
$role = $user->type;
$image_path = $user->image_path;
if($image_path == null)
{
  $image_path = 'assets/img/user/user.png';
}
// Get the user's name
// $email = $user->email; // Get the user's email
?>
<script>
      NProgress.configure({ showSpinner: false });
      NProgress.start();
    </script>


    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="/admin/dashboard" title="Sleek Dashboard">
              <img src="<?php echo e(asset('assets/img/login-image.png')); ?>"  width="30" height="33" alt="">  

                <span class="brand-name text-truncate">Administration</span>
              </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub active">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
                    aria-expanded="false" aria-controls="dashboard">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                    <span class="nav-text">Complains</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse" id="dashboard" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                    <li>
                        <a class="sidenav-item-link" href="/admin/dashboard">
                          <span class="nav-text">Dashboard</span>
                        </a>
                      </li>  
                    <li>
                        <a class="sidenav-item-link" href="/admin/complains">
                          <span class="nav-text">Complain ListView</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
                
                <?php if($role == 1): ?>
                <li class="has-sub active">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app2"
                    aria-expanded="false" aria-controls="Management">
                    <i class="mdi mdi-pencil-box-multiple"></i>
                    <span class="nav-text">Management</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="app2" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="/admin/user_management">
                          <span class="nav-text">Manage User/Staff</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="/admin/category">
                          <span class="nav-text">Categories</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="/admin/sub_category">
                          <span class="nav-text">Sub Categories</span>
                        </a>
                      </li>

                      <li class="">
                        <a class="sidenav-item-link" href="/admin/state">
                          <span class="nav-text">State</span>
                        </a>
                      </li>
                      <li class="">
                        <a class="sidenav-item-link" href="/admin/staff">
                          <span class="nav-text">Add Staff</span>
                        </a>
                      </li>
                      <li class="">
                        <a class="sidenav-item-link" href="/admin/staff_category">
                          <span class="nav-text">Staff Assignment</span>
                        </a>
                      </li>
                    </div>
                  </ul>
                </li>
                <?php endif; ?>
                <li class="has-sub active">
                  <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                    aria-expanded="false" aria-controls="app">
                    <i class="mdi mdi-account"></i>
                    
                    <span class="nav-text">Account Settings</span> <b class="caret"></b>
                  </a>

                  <ul class="collapse " id="app" data-parent="#sidebar-menu">
                    <div class="sub-menu">
                      <li class="">
                        <a class="sidenav-item-link" href="/admin/update-profile">
                          <span class="nav-text">Update Profile</span>
                        </a>
                      </li>

                    </div>
                  </ul>
                </li>
                <li class="has-sub active">
                  <a class="sidenav-item-link" href="/logout"
                    aria-expanded="false" aria-controls="app">
                    <i class="mdi mdi-logout"></i>
                    
                    <span class="nav-text">Logout</span>
                  </a>
                </li>

          </div>
        </aside>


          <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">
          
          <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">
                  
                  
                </div>
                
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  
                  <!-- User Account -->
                  <style>
                    .dropdown-toggle::after{
                      display : none;
                    }
                  </style>
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <img src="<?php echo e(asset($image_path)); ?>" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block"><?php echo e($name); ?></span>
                    </button>
                  </li>
                </ul>
              </div>
            </nav>
          </header><?php /**PATH C:\complain_app\resources\views/admin_header.blade.php ENDPATH**/ ?>