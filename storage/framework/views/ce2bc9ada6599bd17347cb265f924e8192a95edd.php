<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fixmybuild Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(asset('adminpanel/assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminpanel/assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('adminpanel/assets/vendors/css/vendor.bundle.base.css')); ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo e(asset('adminpanel/assets/css/demo_1/style.css')); ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('adminpanel/assets/images/favicon.ico')); ?>">
  </head>
  <body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                  <div class="brand-logo">
                    
                    <img src="<?php echo e(asset('adminpanel/assets/images/logo.png')); ?>">

                  </div>

                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger" role="alert"><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                  <h4>Sign in to continue.</h4>
                  
                  <form action="<?php echo e(route('adminLoginPost')); ?>" name="adminlogin" id="adminlogin" class="pt-3" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group row">
                        
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" id="type1" value="superadmin" checked=""> Super Admin <i class="input-helper"></i></label>
                          </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="type" id="type2" value="reviewer"> Reviewer <i class="input-helper"></i></label>
                          </div>
                        </div>
                      </div>

                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                          <label class="form-check-label text-muted">
                            <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                        </div>
                    </div>
                    <div class="mt-3">
                      <button class="btn btn-block btn-primary btn-lg font-weight-semibold auth-form-btn">SIGN IN</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo e(asset('adminpanel/assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo e(asset('adminpanel/assets/js/off-canvas.js')); ?>"></script>
    <script src="<?php echo e(asset('adminpanel/assets/js/hoverable-collapse.js')); ?>"></script>
    <script src="<?php echo e(asset('adminpanel/assets/js/misc.js')); ?>"></script>
    <script src="<?php echo e(asset('adminpanel/assets/js/settings.js')); ?>"></script>
    <script src="<?php echo e(asset('adminpanel/assets/js/todolist.js')); ?>"></script>
    <!-- endinject -->
  </body>

</html>
<?php /**PATH E:\webdev\FixMyBuild\resources\views/admin/signin/signin.blade.php ENDPATH**/ ?>