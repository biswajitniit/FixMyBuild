@extends('layouts.app')

@section('content')
 <!--Code area start-->
 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Project</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('tradepersion.projects')}}">Project list</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
 <!--Code area end-->
 @php
    $projectStatus = tradesperson_project_status($project->id);
@endphp
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
                         <h2>{{ ucwords($project->project_name) }}</h2>
                      </div>
                   </div>
                   <div class="row mt-4">
                      <div class="col-md-6">
                         <h5>Location</h5>
                      </div>
                      <div class="col-md-6">
                         <h2>
                            @if ($project->postcode){{ \Str::upper($project->postcode).', ' }} @endif @if ($project->town){{ ucwords($project->town).', ' }}@endif @if ($project->county){{ ucwords($project->county) }}@endif
                         </h2>
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
                                @if ($projectStatus == 'estimate_accepted' || $projectStatus == 'project_started')
                                    <a class="nav-item nav-link active" id="nav-milestones-tab" data-toggle="tab" href="#nav-milestones" role="tab" aria-controls="nav-milestones" aria-selected="true">Milestones</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                                @endif
                                @if ($projectStatus == 'estimate_submitted' || $projectStatus == 'estimate_recalled')
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                                @endif
                                @if ($projectStatus == 'estimate_rejected')
                                    <a class="nav-item nav-link active" id="nav-old-estimate-tab" data-toggle="tab" href="#nav-old-estimate" role="tab" aria-controls="nav-old-estimate" aria-selected="true">Old estimate</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                                @endif
                                @if ($projectStatus == 'write_estimate' || $projectStatus == 'need_more_info')
                                    <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                                @endif
                                @if ($projectStatus == 'project_completed' || $projectStatus == 'project_paused' || $projectStatus == 'project_cancelled')
                                    <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-milestones-tab" data-toggle="tab" href="#nav-milestones" role="tab" aria-controls="nav-milestones" aria-selected="false">Milestones</a>
                                @endif
                                @if ($projectStatus == 'estimate_not_accepted')
                                    <a class="nav-item nav-link active" id="nav-old-estimate-tab" data-toggle="tab" href="#nav-old-estimate" role="tab" aria-controls="nav-old-estimate" aria-selected="true">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                @endif
                               </div>
                            </nav>
                         </div>
                         <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                @if ($projectStatus == 'estimate_accepted' || $projectStatus == 'project_started')
                                    @include('tradepersion.milestones')
                                    @include('tradepersion.details')
                                    @include('tradepersion.estimate_tab')
                                    @include('tradepersion.chat')
                                @endif
                                @if ($projectStatus == 'estimate_submitted' || $projectStatus == 'estimate_recalled')
                                    @include('tradepersion.estimate_tab')
                                    @include('tradepersion.details')
                                    @include('tradepersion.chat')
                                @endif
                                @if ($projectStatus == 'estimate_rejected')
                                    @include('tradepersion.old-estimate-tab')
                                    @include('tradepersion.details')
                                    @include('tradepersion.chat')
                                @endif
                                @if ($projectStatus == 'estimate_not_accepted')
                                    @include('tradepersion.old-estimate-tab')
                                    @include('tradepersion.details')
                                    @include('tradepersion.chat')
                                @endif
                                @if ($projectStatus == 'write_estimate' || $projectStatus == 'need_more_info' )
                                    @include('tradepersion.details')
                                    @include('tradepersion.chat')
                                @endif
                                @if ($projectStatus == 'project_completed' || $projectStatus == 'project_paused' || $projectStatus == 'project_cancelled')
                                    @include('tradepersion.details')
                                    @include('tradepersion.estimate_tab')
                                    @include('tradepersion.milestones')
                                @endif
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-5 text-center pre_">
                    <a href="{{ route('tradepersion.projects') }}" class="btn btn-light mr-3">Back</a>
                    @if ($projectStatus == 'write_estimate')
                        <a href="#" data-bs-toggle="modal" data-bs-target="#reject-project"  class="btn btn-light mr-3">Reject project</a>
                        <a href="{{ route('tradepersion.project_estimate',['project_id'=> Hashids_encode($project->id)]) }}" class="btn btn-primary">Estimate now</a>
                    @endif

                    @if ($projectStatus == 'estimate_submitted')
                        <a href="{{ route('tradepersion.project_estimate',['project_id' => Hashids_encode($project->id)]) }}" class="btn btn-primary">Recall estimate</a>
                    @endif

                    @if ($projectStatus == 'estimate_recalled' || $projectStatus == 'estimate_rejected')
                        <a href="{{ route('tradepersion.project_estimate',['project_id'=> Hashids_encode($project->id)]) }}" class="btn btn-primary">Edit estimate</a>
                    @endif
                </div>
                <!-- Reject Project password-->
                <div class="modal fade select_address" id="reject-project" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="#" method="post">
                                <div class="modal-header pb-0">
                                <h5 class="modal-title" id="exampleModalLabel">Reasons for project rejection</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z" fill="black"/>
                                    </svg>
                                </button>
                                </div>
                                <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Please tell us why you would like to reject this project. This will be kept confidential between yourself and our team only.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 mt-1">
                                        <select name="select_reason" class="form-control" id="select_reason" onchange="forOtherReason()">
                                            <option value="" selected>---Select---</option>
                                            <option value="do_not_undertake_the_work">I do not undertake the work described in the project</option>
                                            <option value="not_available_for_work">I'm currently not available for work</option>
                                            <option value="do_not_cover_the_customer's_location">I do not cover the customer's location</option>
                                            <option value="other_reasons">Other reasons</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-md-12 mt-3">
                                        <textarea name="type_other_reason" id="type_other_reason" class="form-control" placeholder="Type your other reasons" style="display: none;"></textarea>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-light" onclick="rejectProject()" id="confirm-reject" disabled>Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- The Modal Reject Project END-->
          </div>
          <!--// END-->
       </form>
    </div>

    {{-- Image/Video Modal --}}
    <div class="modal fade select_address" id="project_media_modal" tabindex="-1" aria-labelledby="project_media_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header pb-0">

                    <h5 class="modal-title" id="project_media_modal_label">Photo/Video</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                fill="black"
                            />
                        </svg>
                    </button>
                </div>
                <div class="modal-body px-2 pb-3 pt-0">
                    <div class="row">
                        <div class="col-md-12 supported_">
                            <img src="" alt="" />
                            <video controls="controls" src="" class="w-100 mt-0"> </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </section>

@if(isset($other_open_projects) && count($other_open_projects) != 0)
    <section class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                <div class="white_bg other-open-proj">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Other open projects</h3>
                            @foreach ($other_open_projects as $key=>$row_project)
                                <div>
                                    {{-- <h5><span>{{ $key+1 }}.</span> {{ $row_project->project_name }} </h5> --}}
                                    <a href="{{ route('tradeperson.project_details', ['project_id' => Hashids_encode($row_project->id)]) }}"><h5><span>{{ $key+1 }}.</span> {{ $row_project->project_name }} </h5></a>
                                    <p>Posted on: {{ time_diff($row_project->created_at) }}</p>
                                </div>
                            @endforeach
                            {{-- <div>
                                <h5><span>2.</span> Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Amet minim mollit non  </h5>
                                <p>Posted on: 12/01/2023</p>
                            </div>
                            <div>
                                <h5><span>3.</span> Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Amet minim mollit non  </h5>
                                <p>Posted on: 11/01/2023</p>
                            </div>
                            <div>
                                <h5><span>4.</span> Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Amet minim mollit non  </h5>
                                <p>Posted on: 11/01/2023</p>
                            </div>
                            <div>
                                <h5><span>5.</span> Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Amet minim mollit non  </h5>
                                <p>Posted on: 10/01/2023</p>
                            </div> --}}

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
@endif
 <!--Code area end-->

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('frontend/js/chat.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        var contingency = response.contingency;
                        var formattedContingency = parseFloat(contingency).toFixed(2);
                        displayVal.text(formattedContingency);
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
            let checkbox = $(this);
            let task_id = checkbox.val();
            let pencil = $('#pencil'+task_id);
            $.ajax({
                url: '{{ route("tradeperson.update-task-status") }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_id: task_id,

                },
                success: function(response) {
                    checkbox.prop('checked', true);
                    checkbox.prop('disabled', true);
                    pencil.addClass('d-none');
                },
                error: function(xhr) {

                }
            });

        });

        function paid_initial(x){
            let checkbox = $('#initial_payment_check');
            let task_id = x;
            $.ajax({
                url: '{{ route("tradeperson.update-task-status") }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_id: task_id,

                },
                success: function(response) {
                    console.log(response)
                    checkbox.prop('checked', true);
                    checkbox.prop('disabled', true);
                },
                error: function(xhr) {

                }
            });
        }


        function submitMessage(event){
            // $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+$('#messsageInput').val()+'</p></div></div>');
            // SEND MESSAGE TO THE CHOSEN USER
            $.ajax({
                method: 'POST',
                url: '{{ route("tradeperson.chat") }}',
                data:{
                    _token: '{{ csrf_token() }}',
                    from_user_id: $('#from_user_id').val(),
                    to_user_id: $('#to_user_id').val(),
                    project_id: $('#project_id').val(),
                    estimate_id: $('#estimate_id').val(),
                    message: $('#type_msg').val()
                },
                success: function(response){
                    // $('#outgoing_msg').html(response.message);
                    // $('#last_msg_id').html(response.last_insert_id);
                    $('#last_msg_id').val(response.last_insert_id);
                    // loadMessagesOfThisConvo();
                    retrieveMessages();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function retrieveMessages(){
            let i=0;
            const authUser =  $('#from_user_id').val();
            const to_user_id = $('#to_user_id').val();
            var lastMessageId = $('#last_msg_id').val();
            $.ajax({
                method: 'GET',
                // url: '/retrive-new-msg/'+to_user_id+'/'+authUser+'/'+lastMessageId,
                url: '{{ route("tradeperson.retrive-new-msg") }}',
                data : {
                    _token: '{{ csrf_token() }}',
                    from_user_id : authUser ,
                    to_user_id : to_user_id,
                    project_id: $('#project_id').val(),
                    last_msg_id : lastMessageId
                },
                success: function(response){
                    while(response[i]!=null){
                        if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id == {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                        <div class="tick mr-2">
                                                <img width="22px" src="{{ asset('images/mdi_tick.png') }}" alt="seen message">
                                            </div>
                                        <div class="msg">
                                            ${response[i].message}
                                        </div>
                                        <div>
                                    </div>
                                </div>`;

                            $('.user2:last-of-type').append(html);
                        }
                        else if($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id == {{ Auth::id() }}) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                                <div class="user2">
                                    <div class="name-time">
                                        <span class="time">${ukTime}</span>
                                        <span class="user-img"><img src="{{ Auth::user()->profile_image }}" class="user-img-chat" alt=""></span>
                                    </div>
                                    <div class="msg-area">
                                        <div class="tick mr-2">
                                            <img src="{{ asset('images/mdi_tick.png') }}" alt="">
                                        </div>
                                        <div class="msg">
                                            ${response[i].message}
                                        </div>
                                        <div></div>
                                    </div>
                                </div>`
                            $('.chat-window').append(html);
                        } else if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id != {{ Auth::id() }}) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                            <div class="user1">
                                <div class="name-time">
                                    <span class="user-img"><img src="{{ asset('images/user1.png') }}" class="user-img-chat" alt=""></span>
                                    <span class="user-name">Jane Cooper</span>
                                    <span class="time">10:30</span>
                                </div>
                                <div class="msg-area">
                                    <div class="msg">
                                        ${response[i].message}
                                    </div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.chat-window').append(html);
                        } else if($('.chat-window > div:last-child').attr('class') != 'user2' && response[i].from_user_id != {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                    <div class="msg">
                                        ${response[i].message}
                                    </div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('.user1:last-of-type').append(html);
                        }
                        // var html = `<div class="msg-area">
                        //             <div class="tick mr-2">
                        //                     <img width="22px" src="{{ asset('images/mdi_tick.png') }}" alt="seen message">
                        //                 </div>
                        //             <div class="msg">
                        //                 ${response[i].message}
                        //             </div>
                        //             <div>
                        //         </div>
                        //     </div>`;

                        // $('.user2').append(html);

                        // $('.user2').append('<div class="msg" id="outgoing_msg">'+response[i].message +'</div>');
                        // lastMessageId = response[i].id + 1;
                        console.log('hello 1');
                        lastMessageId = response[i].id + 1;
                        $('#last_msg_id').val(lastMessageId);
                        i++;
                        $('#type_msg').val('');
                    }
                    console.log('hello');
                    // scrollPaubos();
                },
                complete: function(response){
                    // retrieveMessages();
                }
            });
        }

        // function scrollPaubos(){
        //     console.log('hii');
        //     var a = document.getElementsByClassName('chat-window');
        //     a.scrollTop = a.scrollHeight;
        // }

        function loadMessagesOfThisConvo(last_msg_id=$('#last_msg_id').val()){
            console.log("loding")
            i=0;
            const authUser =  $('#from_user_id').val();
            const to_user_id = $('#to_user_id').val();
            var last_msg_id = $('#last_msg_id').val();
            console.log(authUser,to_user_id)
            $.ajax({
                method: 'GET',
                // url: '/load-msg/'+to_user_id+'/'+authUser,
                url: '{{ route("tradeperson.load-msg")}}',
                data:{
                    _token: '{{ csrf_token() }}',
                    from_user_id : authUser ,
                    to_user_id : to_user_id,
                    project_id: $('#project_id').val(),
                    last_msg_id : last_msg_id
                },
                success: function(response){
                    // $('#sender_msg').html('');
                    // console.log('from loadMessagesOfThisConvo');
                    // while(response[0][i]!=null){
                    //     if(response[1][0] == response[0][i].message_users_id ){
                    //         $('#sender_msg').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+response[0][i].message +'</p></div></div>');
                    //     }else{
                    //         $('#sender_msg').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[0][i].message +'</p></div></div>');
                    //     }
                    //     // lastMessageId = response[0][i].id + 1;
                    //     lastMessageId = response[i].id + 1;
                    //     $('#last_msg_id').val(lastMessageId);
                    //     i++;
                    // }
                    // scrollPaubos();
                    // retrieveMessages();
                    while(response[i]!=null){
                        if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id == {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                        <div class="tick mr-2">
                                                <img width="22px" src="{{ asset('images/mdi_tick.png') }}" alt="seen message">
                                            </div>
                                        <div class="msg">
                                            ${response[i].message}
                                        </div>
                                        <div>
                                    </div>
                                </div>`;

                            $('.user2:last-of-type').append(html);
                        }
                        else if($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id == {{ Auth::id() }}) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                                <div class="user2">
                                    <div class="name-time">
                                        <span class="time">${ukTime}</span>
                                        <span class="user-img"><img src="{{ Auth::user()->profile_image }}" class="user-img-chat" alt=""></span>
                                    </div>
                                    <div class="msg-area">
                                        <div class="tick mr-2">
                                            <img src="{{ asset('images/mdi_tick.png') }}" alt="">
                                        </div>
                                        <div class="msg">
                                            ${response[i].message}
                                        </div>
                                        <div></div>
                                    </div>
                                </div>`
                            $('.chat-window').append(html);
                        } else if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id != {{ Auth::id() }}) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                            <div class="user1">
                                <div class="name-time">
                                    <span class="user-img"><img src="{{ asset('images/user1.png') }}" class="user-img-chat" alt=""></span>
                                    <span class="user-name">Jane Cooper</span>
                                    <span class="time">${ukTime}</span>
                                </div>
                                <div class="msg-area">
                                    <div class="msg">
                                        ${response[i].message}
                                    </div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.chat-window').append(html);
                        } else if($('.chat-window > div:last-child').attr('class') != 'user2' && response[i].from_user_id != {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                    <div class="msg">
                                        ${response[i].message}
                                    </div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('.user1:last-of-type').append(html);
                        }
                        lastMessageId = response[i].id + 1;
                        $('#last_msg_id').val(lastMessageId);
                        i++;
                        $('#type_msg').val('');
                    }
                }
            });
        }

        loadMessagesOfThisConvo(0);

        function forOtherReason() {
            let e = document.getElementById('select_reason');
            if (e.value === 'other_reasons') {
                    document.getElementById('type_other_reason').style.display = 'block';
            } else {
                document.getElementById('type_other_reason').style.display = 'none';
            }
            disableRejectProject();
        }

        function disableRejectProject() {
            $('#select_reason').val() == '' ? $('#confirm-reject').prop('disabled', true) : $('#confirm-reject').prop('disabled', false);
        }

        function rejectProject() {
            var projectid = '{{ Hashids_encode($project->id) }}';
            var reason = $('#select_reason').val();
            var more_details = $('#type_other_reason').val();
            $.ajax({
                url: '{{ route("reject-project") }}',
                type: 'POST',
                data: {
                    _token : '{{ csrf_token() }}',
                    reason : reason,
                    more_details : more_details,
                    project_id : projectid
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'You have successfully rejected the project'
                    });
                    window.location.href = response.redirect_url;
                },
                error: function(xhr, error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!! something went wrong',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }

        $(function(){
            let modal_video = $('#project_media_modal .modal-body video');
            let modal_image = $('#project_media_modal .modal-body img');

            $('.pv_top img').on('click', function(){
                let photo_url = $(this).attr('src');

                $('#project_media_modal').on('show.bs.modal', function(event){
                    modal_video.addClass('hidden');
                    modal_image.attr('src', photo_url);
                });

                $('#project_media_modal').on('hidden.bs.modal',function(event){
                    modal_image.attr('src', '');
                    photo_url='';
                });

                $('#project_media_modal').modal('show');
            });

            $('.pv_top .video-mask video').on('click', function(){
                console.log('Clicking on Video');
                let video_url = $(this).attr('src');

                $('#project_media_modal').on('show.bs.modal', function(event){
                    modal_video.removeClass('hidden');
                    modal_video.attr('src', video_url);
                });

                // $('#project_media_modal').on('show.bs.modal', function(event){
                //     $('#project_media_modal .modal-body video').attr('src', video_url);
                // });

                $('#project_media_modal').modal('show');
            });
        });

    </script>
@endpush
