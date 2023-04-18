

<?php $__env->startSection('content'); ?>
<!--Code area start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 fmb_titel">
                <h1>My profile</h1>
                <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Project</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!--Code area end-->
<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li><a href="<?php echo e(route('customer.profile')); ?>">Profile</a></li>
                    <li class="active"><a href="<?php echo e(route('customer.project')); ?>">Projects</a></li>
                    <li><a href="<?php echo e(route('customer.notifications')); ?>">Notifications</a></li>
                    <li><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="white_bg mb-5">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>
                                New project(s)
                                <span>
                                    <a href="<?php echo e(route('customer.newproject')); ?>"> <i class="fa fa-plus"></i> Add new</a>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="row table_wrap">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                   <tr>
                                      <th style="width:80px;">#</th>
                                      <th style="width:140px;">Name</th>
                                      <th style="width:140px;">Posting date</th>
                                      <th style="width:340px;">Status</th>
                                      <th style="width:80px;"></th>
                                      <th style="width:auto;"></th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <?php if($project): ?>
                                        <?php
                                            $count = 1;
                                        ?>
                                       <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($count); ?></td>
                                                <td><?php echo e($row->forename.' '.$row->surname); ?></td>
                                                <td><?php echo e(date('d/m/Y',strtotime($row->created_at))); ?> <br> <em> <?php echo e(date('h:i a',strtotime($row->created_at))); ?> </em> </td>
                                                <td class="text-success">Project started</td>
                                                <td><a href="#"><img src="<?php echo e(asset('frontend/img/chat-info.svg')); ?>" alt=""></a></td>
                                                <td><a href="#" class="btn btn-view">View</a></td>
                                            </tr>
                                            <?php
                                                $count++;
                                            ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>


                                </tbody>
                             </table>
                        </div>
                    </div>
                </div>
                <!--//-->
                
                <!--//-->
            </div>
        </div>
        <!--// END-->
    </div>
</section>
<!--Code area end-->




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp7\htdocs\FixMyBuild\resources\views/customer/project.blade.php ENDPATH**/ ?>