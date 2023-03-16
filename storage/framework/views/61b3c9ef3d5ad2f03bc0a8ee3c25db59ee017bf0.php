<?php $__env->startSection('title', 'Awaiting your review'); ?>
<?php $__env->startSection('content'); ?>

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add Category </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('buildercategory.index')); ?>">Categorys</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
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

                <?php if(session()->has('message')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message')); ?>

                    </div>
                <?php endif; ?>



              <form class="cmxform" id="addcategory" method="post" action="<?php echo e(route('buildercategory.store')); ?>" name="addcategory">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="simpleinput">Text</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="simpleinput" value="Some text value..." />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-email">Email</label>
                            <div class="col-lg-10">
                                <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-password">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="example-password" value="password" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-placeholder">Placeholder</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" placeholder="placeholder" id="example-placeholder" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-textarea">Text area</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" rows="5" id="example-textarea"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Readonly</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" readonly="" value="Readonly value" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Disabled</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" disabled="" value="Disabled value" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-static">Static control</label>
                            <div class="col-lg-10">
                                <input type="text" readonly="" class="form-control-plaintext" id="example-static" value="email@example.com" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label" for="example-helping">Helping text</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="example-helping" placeholder="Helping text" />
                                <span class="help-block">
                                    <small> A block of help text that breaks onto a new line and may extend beyond one line.</small>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-form-label">Input Select</label>
                            <div class="col-lg-10">
                                <select class="form-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>



              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <?php echo $__env->make('admin.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <!-- main-panel ends -->








<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\webdev\FixMyBuild\resources\views/admin/reviewer/awaiting-your-review-show.blade.php ENDPATH**/ ?>