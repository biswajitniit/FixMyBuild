<?php $__env->startSection('title', 'Awaiting your review'); ?>
<?php $__env->startSection('content'); ?>

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Awaiting your review </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin/project/awaiting-your-review')); ?>">Awaiting your review</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Review</li>
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



              <form class="cmxform" id="save_awaiting_review" method="post" action="<?php echo e(route('awaiting-your-review-save')); ?>" name="save_awaiting_review">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="projectid" value="<?php echo e($project->id); ?>">

                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Name of the project</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="simpleinput" value="<?php echo e($project->project_name); ?>" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5" id="editor-description"><?php echo e($project->description); ?></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Attachments</label>
                            <div class="col-lg-9">
                                <div class="row bg-light p-3">

                                    <?php if($projectmedia): ?>
                                        <?php $__currentLoopData = $projectmedia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowprojectmedia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $file_ext = pathinfo($rowprojectmedia->url, PATHINFO_EXTENSION);
                                            ?>

                                            <?php if($file_ext=="jpg" || $file_ext=="png" || $file_ext=="JPG" || $file_ext=="PNG"): ?>
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="<?php echo e(@$rowprojectmedia->url); ?>" target="_blank" title="View image">
                                                            <img class="card-img-top img-fluid" src="<?php echo e(@$rowprojectmedia->url); ?>" alt="jpg" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            <?php endif; ?>

                                            <?php if($file_ext=="xlsx" || $file_ext=="xls"): ?>
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="<?php echo e(@$rowprojectmedia->url); ?>" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="<?php echo e(asset('adminpanel/file/excels.webp')); ?>" alt="xls" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            <?php endif; ?>

                                            <?php if($file_ext=="pdf"): ?>
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="<?php echo e(@$rowprojectmedia->url); ?>" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="<?php echo e(asset('adminpanel/file/pdf.png')); ?>" alt="pdf" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            <?php endif; ?>

                                            <?php if($file_ext=="mov" || $file_ext=="mp4" || $file_ext=="3gp" || $file_ext=="ogg" || $file_ext=="webm" || $file_ext=="avi" || $file_ext=="mov" || $file_ext=="wmv"): ?>
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="<?php echo e(@$rowprojectmedia->url); ?>" target="_blank" title="View video">
                                                            <img class="card-img-top img-fluid" src="<?php echo e(asset('adminpanel/file/video.jpg')); ?>" alt="pdf" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>



                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                            <div class="col-lg-9">
                                <input type="checkbox" data-toggle="switchbutton" checked data-onlabel="Approve" data-offlabel="Refer" data-onstyle="success" data-offstyle="danger">
                                <div id="approve"
                                    <a onclick="return show_refer('Approve')">Approve</a>
                                </div>
                                <div id="refer"
                                    <a onclick="return show_approve('Refer')">Refer</a>
                                </div>

                                <input type="hidden" id="your_decision" value="Approve">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Notes and Comments</label>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                        <div class="row">
                            <table class="table-hover" id="customFields" style="width:100%">
                                <tbody id="TextBoxesGroup">
                                    <tr valign="top">
                                        <td>
                                            <select name="notes_for[]" id="notes_for1" class="form-select">
                                                <option value="internal">Internal</option>
                                                <option value="customer">To Customer</option>
                                                <option value="tradespeople">For Tradespeople</option>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="description[]" id="description1" class="form-control" style="height: 20px"></textarea>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <input type="hidden" id="count_total_record_id" value="1" />
                            </table>
                            <!-- end col -->
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="addCF" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-dual"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>

                                </div>
                            </div>
                            <!-- end col -->
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Categories</label>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card" style="height:250px; overflow-y: scroll;">
                                    <div class="card-body">

                                        <?php if($buildercategory): ?>
                                            <?php $__currentLoopData = $buildercategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mt-1">
                                                <div class="form-check mb-1">
                                                    <input type="checkbox" name="builder_category[]" class="form-check-input catid" id="customCheck<?php echo e($rowcategory->id); ?>" value="<?php echo e($rowcategory->id); ?>"  onclick="get_builder_subcategory_list(this.value)"/>
                                                    <label class="form-check-label" for="customCheck<?php echo e($rowcategory->id); ?>"><?php echo e($rowcategory->builder_category_name); ?></label>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="height:250px; overflow-y: scroll;">
                                    <div class="card-body" id="buildersubcategory">

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                    </div>

                    <div class="row mt-15">
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit">
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
function get_builder_subcategory_list() {
    var val = [];
    $('.catid:checked').each(function(i) {
        val[i] = $(this).val();
    });

    if(val!=''){
        $.ajax({
            type:'POST',
            url:'<?php echo e(route("get-builder-subcategory-list")); ?>',
            data:{catid:val,_token: '<?php echo e(csrf_token()); ?>'},
            success:function(result){
                $("#buildersubcategory").html(result);
            }
        });
    }
}

$(document).ready(function(){
    $("#addCF").click(function(){
        if($("#count_total_record_id").val() != ""){
            var counter = parseInt($("#count_total_record_id").val()) + 1;
            $("#count_total_record_id").attr('value',counter);
        }else{
            var counter = 2;
            $("#count_total_record_id").attr('value',counter);
        }
        var newTextBoxDiv = $(document.createElement('tr'));
        newTextBoxDiv.after().html('<td><select name="notes_for[]" id="notes_for'+counter+'" class="form-select" ><option value="internal">Internal</option><option value="customer">To Customer</option><option value="tradespeople">For Tradespeople</option></select></td><td><textarea name="description[]" class="form-control" id="description'+counter+'"></textarea></td><td><a href="javascript:void(0);" class="remCF"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a></td>');
        newTextBoxDiv.appendTo("#TextBoxesGroup");
        counter++;
        $(".remCF").on('click',function(){
            $(this).parent().parent().remove();
        });
    });
});

</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\webdev\FixMyBuild\resources\views/admin/reviewer/awaiting-your-review-show.blade.php ENDPATH**/ ?>