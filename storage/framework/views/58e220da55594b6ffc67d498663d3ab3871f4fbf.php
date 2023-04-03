<?php $__env->startSection('title', 'Awaiting your review'); ?>
<?php $__env->startSection('content'); ?>


<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Awaiting your review</h3>
            <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                
            </div>
        </div>

        <?php if(session()->has('message')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('message')); ?>

            </div>
        <?php endif; ?>



        <!-- first row starts here -->


        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Awaiting your review</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-none" id="my-table">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Name</th>
                                        
                                        <th>Posting date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($projects->forename.' '.$projects->surname); ?></td>
                                        
                                        <td><?php echo e(date('d/m/Y h:i a',strtotime($projects->created_at))); ?></td>
                                        <td><?php echo e(str_replace("_", " ", $projects->status)); ?></td>
                                        <td><a href="<?php echo e(route('awaiting-your-review-show',[$projects->id])); ?>" title="View Projects"><i class="mdi mdi-eye"></i></a></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="myModal" class="modal fade" role="dialog" >
            <div class="modal-dialog" style="width:700px;max-width:initial;height:500px;">
            <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>" target="_blank">FixMyBuild</a>. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->







<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    // $(document).ready(function(){
    //     // DataTable
    //         $('#my-table').DataTable({
    //             processing: true,
    //             serverSide: true,
    //             lengthMenu: [[100, 200, 300], [100, 200, 300]],
    //             order: [[ 0, "asc" ]],
    //             columnDefs: [{
    //                 "searchable": true,
    //                 "orderable": false,
    //                 "targets": 0
    //             }],
    //             "ajax": {
    //                 data: ({_token: '<?php echo e(csrf_token()); ?>'}),
    //                 url : "<?php echo e(route('admin.user-list-datatable')); ?>",
    //                 type : 'GET',
    //             },
    //             columns: [
    //                     {data: 'name' },
    //                     {data: 'email' },
    //                     {data: 'phone' },
    //                     {data: 'customer_or_tradesperson' },

    //                     {
    //                         data: 'status',
    //                         render: function (data, type, row){
    //                             if(data == "Active"){
    //                                 return '<label class="badge badge-success">Active</label>';
    //                             }else{
    //                                 return '<label class="badge badge-danger">In Active</label>';
    //                             }
    //                         },
    //                     },
    //                    {
    //                         data: 'action',
    //                         render: function (data, type, row){
    //                             return '<a href="" title="Edit User"><i class="mdi mdi-table-edit"></i></a>';
    //                         },
    //                     },

    //             ]
    //         });
    //     });

    //     function confirmMsg(e)
    //     {
    //         var answer = confirm("Are you sure you want to delete this record?")
    //         if (answer){
    //             return true;
    //         }
    //         e.preventDefault();
    //     }

</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\webdev\FixMyBuild\resources\views/admin/reviewer/awaiting-your-review.blade.php ENDPATH**/ ?>