<?php $__env->startSection('title', 'Final review'); ?>
<?php $__env->startSection('content'); ?>

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Final review </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin/project/awaiting-your-review')); ?>">Final review</a></li>
            <li class="breadcrumb-item active" aria-current="page">Final Review</li>
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



              <form class="cmxform" id="save_awaiting_review" method="post" action="<?php echo e(route('awaiting-your-review-final-save')); ?>" name="save_awaiting_review">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="projectid" value="<?php echo e(Request::segment(4)); ?>">

                <div class="row">
                    <div class="row mt-15">
                        <div class="col-md-12">

                            <?php if($projectnotesandcommend): ?>
                                <?php $__currentLoopData = $projectnotesandcommend; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($row->notes_for == 'internal'): ?>
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="example-textarea">Notes for <?php echo e($row->notes_for); ?></label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="5"><?php echo $row->notes ?></textarea>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($row->notes_for == 'tradespeople'): ?>
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="example-textarea">Notes for <?php echo e($row->notes_for); ?></label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="5"><?php echo $row->notes ?></textarea>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($row->notes_for == 'customer'): ?>
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="example-textarea">Notes for <?php echo e($row->notes_for); ?></label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="5" id="editor-description"><?php echo $row->notes ?></textarea>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>


                            <a href="<?php echo e(url('/admin/project/awaiting-your-review-show/'.Request::segment(4))); ?>" class="btn btn-light">Back</a>

                            <input type="submit" class="btn btn-primary" value="Send">
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
<script>
    CKEDITOR.replace( 'editor-description' );
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\webdev\FixMyBuild\resources\views/admin/reviewer/final-review.blade.php ENDPATH**/ ?>