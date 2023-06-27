@extends('layouts.app')

@section('content')
 <!--Code area start-->
 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Project</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="projects-tradesperson.html">Project list</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
 <!--Code area end-->
 <!--Code area start-->
 <section class="pb-5">
    <div class="container">
       <form action="#" method="post">

          <div class="row mb-5">
             <div class="col-md-10 offset-md-1">
                <div class="tell_about pl-details">
                   <div class="row">
                      <div class="col-md-6">
                         <h5>Customer’s project name</h5>
                      </div>
                      <div class="col-md-6">
                         <h2>Renovate my house</h2>
                      </div>
                   </div>
                   <div class="row mt-4">
                      <div class="col-md-6">
                         <h5>Location</h5>
                      </div>
                      <div class="col-md-6">
                         <h2>London</h2>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!--// END-->
          <div class="row">
             <div class="col-md-10 offset-md-1">
                <div class="row mb-5">
                   <div class="col-12 tab_wrap milestone_">
                      <div class="card card-wrap">
                         <div class="card-header">
                            <nav>
                               <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-milestones-tab" data-toggle="tab" href="#nav-milestones" role="tab" aria-controls="nav-milestones" aria-selected="true">Milestones</a>
                                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                               </div>
                            </nav>
                         </div>
                         <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                @include('tradepersion.milestones')
                                @include('tradepersion.estimate_tab')
                                @include('tradepersion.details')
                                @include('tradepersion.chat')
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-5 text-center pre_">
                    <a href="projects-tradesperson.html" class="btn btn-light mr-3">Back</a>
                    <a href="{{ route('tradepersion.project_estimate',['project_id' => $project->id]) }}" class="btn btn-primary">Recall Estimate</a>
                </div>
          </div>
          <!--// END-->
       </form>
    </div>
 </section>
 <!--Code area end-->

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('frontend/js/chat.js') }}"></script>
    <script>
        $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 200
        });
        // When the user clicks on div, open the popup
        function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
        }


        function signChange(e, key) {
            var plusIcon = $(e).find(".plus-icon");
            var minusIcon = $(e).find(".minus-icon");
            let tr_desc = $(e).closest('tr').next('tr.description-ms_');

            $('.description-ms_').not(tr_desc).addClass('d-none');
            $('.minus-icon').not(minusIcon).addClass('d-none');
            $('.plus-icon').not(plusIcon).removeClass('d-none');

            tr_desc.toggleClass('d-none');

            plusIcon.toggleClass("d-none");
            minusIcon.toggleClass("d-none");
        }


        //price edit and save for <tr>
        function edit(e) {
            let displayVal = $(e).closest('td').find('.displayVal');
            let inpVal = $(e).closest('td').find('.inputValue');
            displayVal.addClass('d-none');
            inpVal.val(displayVal.text());
            inpVal.removeClass('d-none');

            $(e).addClass('d-none');
            $(e).closest('td').find('.clickSave').removeClass('d-none');
        }


        function save(e) {
            var row = $(e).closest('tr');
            var taskId = row.data('id');
            var contingencyInput = row.find('.inputValue');
            var contingency = contingencyInput.val();

            $.ajax({
                url: "{{ route('tradeperson.update-milestone-price') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    contingency: contingency,
                    taskId: taskId
                },
                success: function(response) {
                    if(response){
                        let displayVal = $(e).closest('td').find('.displayVal');
                        let inpVal = $(e).closest('td').find('.inputValue');
                        inpVal.addClass('d-none');
                        displayVal.text(response.contingency);
                        displayVal.removeClass('d-none');

                        $(e).addClass('d-block');
                        $(e).closest('td').find('.clickSave').removeClass('d-block').addClass('d-none');
                        $(e).closest('td').find('.clickPencil').removeClass('d-none');

                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // checkbox for <tr>

        $('.toggle-class').on('change',function(){
            let task_id = $(this).closest('tr').attr('data-id');
            let status = $(this).prop('checked') ? 'Active' : 'Inactive';
            $.ajax({
                url: '{{ route('tradeperson.update-task-status') }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    task_id: task_id,
                },
                error: function(xhr) {

                }
            });

        });


    </script>
@endpush
