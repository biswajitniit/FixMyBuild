@extends('layouts.app')

@section('content')
 <!--Code area start-->
@php
    $status=$project->status;
@endphp
 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Project</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customer.project')}}">Project list</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
 <!--Code area end-->
 @php
    $status=$project->status;
@endphp
 <!--Code area start-->
 <section class="pb-5">
    <div class="container">
        @if($estimate->status == 'rejected')
            <div class="alert alert-warning offset-1 col-md-10">You have rejected the estimate. Please wait some days to get new estimate.</div>
        @endif
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
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Estimate</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About company</a>
                                    <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                    <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat
                                        {{-- <span class="badge badge-secondary">2</span> --}}
                                    </a>
                               </div>
                            </nav>
                         </div>
                         <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                @include('customer.estimate_tab')
                                @include('customer.about-company')
                                @include('customer.details')
                                @include('customer.chat')
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-5 text-center pre_">
                    <a href="{{route('customer.project')}}" class="btn btn-light mr-3">Back</a>
                    @if($estimate->status == null)
                        <a href="#" class="btn btn-light mr-3" data-bs-toggle="modal" data-bs-target="#reject">Reject</a>
                        @if(Auth::user()->is_email_verified == 0)
                            <span title="please verify your email to accept estimates" class="d-inline-block"><button type="button" class="btn btn-primary disable-btn" disabled>Accept</button></span>
                        @else
                            <a href="{{ route('tradepersion.project_estimate',['project_id' => $project->id]) }}" data-bs-toggle="modal" data-bs-target="#accept" class="btn btn-primary">Accept</a>
                        @endif
                    @endif
                </div>
                <!-- The Modal Accept received-->
                <div class="modal fade select_address accept" id="accept" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                       <div class="modal-content successfull_wrap">
                          <div class="modal-body text-left">
                             <h4>Would you like to share your personal details with the tradesperson?</h4>
                             <p>Which of these can be shared with your chosen tradesperson:</p>
                             <div class="row mb-5">
                                <div class="col-md-6">
                                   <div class="row">
                                      <div class="col-md-12">
                                         <div class="form-check form-switch">
                                            <div class="switchToggle">
                                               <input type="checkbox" id="name">
                                               <label for="name">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Name</label>
                                         </div>
                                      </div>
                                      <!--//-->
                                      <div class="col-md-12">
                                         <div class="form-check form-switch">
                                            <div class="switchToggle">
                                               <input type="checkbox" id="address">
                                               <label for="address">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Address</label>
                                         </div>
                                      </div>
                                      <!--//-->
                                      <div class="col-md-12">
                                         <div class="form-check form-switch">
                                            <div class="switchToggle">
                                               <input type="checkbox" id="home_phone">
                                               <label for="home_phone">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Home Phone</label>
                                         </div>
                                      </div>
                                      <!--//-->
                                   </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="row">
                                      <div class="col-md-12">
                                         <div class="form-check form-switch">
                                            <div class="switchToggle">
                                               <input type="checkbox" id="mobile_phone">
                                               <label for="mobile_phone">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Mobile phone</label>
                                         </div>
                                      </div>
                                      <!--//-->
                                      <div class="col-md-12">
                                         <div class="form-check form-switch">
                                            <div class="switchToggle">
                                               <input type="checkbox" id="email">
                                               <label for="email">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Email</label>
                                         </div>
                                      </div>
                                      <!--//-->
                                   </div>
                                </div>
                             </div>
                             <div class="form-check">
                                <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="clarified" onclick="disable()">I confirm that the tasks above cover the work I requested and I have clarified any doubts directly with the tradesperson.
                                </label>
                             </div>
                             <div class="form-check">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="terms_of_service" name="terms_of_service" value="1" @if(old('terms_of_service') == 1) checked @endif onclick="disable()" required/> I have read and agree to FixMyBuild's
                                    <a href="{{ route('termspage') }}">Terms of Service</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                                </label>
                             </div>
                          </div>
                          <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-light">Back</button> <button type="button" id="continue_" onclick="forAccept()" class="btn btn-light" disabled>Continue</button>
                          </div>
                       </div>
                    </div>
                </div>
                <!-- The Modal Accept received END-->

                <!-- Reject Modal -->
                <div class="modal fade select_address" id="reject" tabindex="-1" aria-labelledby="RejectModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body text-center p-5">
                            <svg width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M36.5 0C29.281 0 22.2241 2.14069 16.2217 6.15136C10.2193 10.162 5.54101 15.8625 2.77841 22.532C0.0158149 29.2015 -0.707007 36.5405 0.701354 43.6208C2.10971 50.7011 5.586 57.2048 10.6906 62.3094C15.7952 67.414 22.2989 70.8903 29.3792 72.2986C36.4595 73.707 43.7984 72.9842 50.4679 70.2216C57.1374 67.459 62.838 62.7807 66.8486 56.7783C70.8593 50.7759 73 43.719 73 36.5C72.9907 26.8224 69.1422 17.5439 62.2991 10.7009C55.4561 3.8578 46.1776 0.00929194 36.5 0ZM36.5 67.3846C30.3916 67.3846 24.4204 65.5732 19.3414 62.1796C14.2625 58.786 10.3039 53.9624 7.96635 48.319C5.62877 42.6756 5.01715 36.4657 6.20884 30.4747C7.40053 24.4837 10.342 18.9806 14.6613 14.6613C18.9806 10.342 24.4837 7.40051 30.4747 6.20882C36.4657 5.01713 42.6756 5.62875 48.319 7.96633C53.9625 10.3039 58.786 14.2625 62.1796 19.3414C65.5733 24.4204 67.3846 30.3916 67.3846 36.5C67.3753 44.6882 64.1184 52.5385 58.3285 58.3284C52.5385 64.1184 44.6883 67.3753 36.5 67.3846ZM40.7115 54.75C40.7115 55.583 40.4645 56.3972 40.0018 57.0898C39.539 57.7824 38.8812 58.3222 38.1117 58.6409C37.3421 58.9597 36.4953 59.0431 35.6784 58.8806C34.8614 58.7181 34.111 58.317 33.522 57.728C32.933 57.139 32.5319 56.3886 32.3694 55.5716C32.2069 54.7547 32.2903 53.9079 32.6091 53.1383C32.9278 52.3687 33.4676 51.711 34.1602 51.2482C34.8528 50.7855 35.667 50.5384 36.5 50.5384C37.617 50.5384 38.6882 50.9822 39.478 51.772C40.2678 52.5618 40.7115 53.633 40.7115 54.75ZM49.1346 29.4808C49.1346 32.3437 48.1623 35.1218 46.3769 37.3599C44.5916 39.5979 42.0991 41.1633 39.3077 41.7995V42.1154C39.3077 42.86 39.0119 43.5742 38.4853 44.1007C37.9588 44.6273 37.2447 44.9231 36.5 44.9231C35.7554 44.9231 35.0412 44.6273 34.5147 44.1007C33.9881 43.5742 33.6923 42.86 33.6923 42.1154V39.3077C33.6923 38.563 33.9881 37.8489 34.5147 37.3223C35.0412 36.7958 35.7554 36.5 36.5 36.5C37.8883 36.5 39.2454 36.0883 40.3997 35.317C41.554 34.5458 42.4537 33.4495 42.9849 32.1669C43.5162 30.8843 43.6552 29.473 43.3844 28.1114C43.1135 26.7498 42.445 25.4991 41.4634 24.5174C40.4817 23.5358 39.231 22.8672 37.8694 22.5964C36.5078 22.3256 35.0965 22.4646 33.8139 22.9958C32.5313 23.5271 31.435 24.4268 30.6637 25.5811C29.8924 26.7354 29.4808 28.0925 29.4808 29.4808C29.4808 30.2254 29.185 30.9396 28.6584 31.4661C28.1319 31.9926 27.4177 32.2885 26.6731 32.2885C25.9284 32.2885 25.2143 31.9926 24.6877 31.4661C24.1612 30.9396 23.8654 30.2254 23.8654 29.4808C23.8654 26.1299 25.1965 22.9162 27.566 20.5467C29.9354 18.1773 33.1491 16.8461 36.5 16.8461C39.8509 16.8461 43.0646 18.1773 45.434 20.5467C47.8035 22.9162 49.1346 26.1299 49.1346 29.4808Z" fill="#061A48"/>
                                </svg>
                                <h5>Reject Project</h5>
                                <p>Are you sure you want to reject?</p>
                                <h4 class="text-danger"></h4>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-light"  onclick="reject()" id="confirmedDelete">Yes</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Reject Modal END -->
            </div>
          <!--// END-->
        </form>
    </div>

    {{-- Modal to view Image and Video --}}
    {{-- <div class="modal fade select_address" id="project_media_modal" tabindex="-1" aria-labelledby="project_media_modal_label" aria-hidden="true">
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
    </div> --}}
    {{-- Modal to view Image and Video --}}
</section>
<!--Code area end-->
@include('includes.photoVideoModal')
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 200
        });
        // When the user clicks on div, open the popup
        // function myFunction() {
        // var popup = document.getElementById("myPopup");
        // popup.classList.toggle("show");
        // }

        function myFunction(element) {
            $(element).find('.myPopup').toggleClass("show");
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
            let task_id = $(this).closest('tr').attr('data-id');
            let status = $(this).prop('checked') ? 'Active' : 'Inactive';
            let pencil = $('#pencil'+task_id);
            // let pencil=document.getElementById('pencil'+task_id);
            $(this).prop('checked') ?pencil.addClass('d-none'):pencil.removeClass('d-none');
            $.ajax({
                url: '{{ route("tradeperson.update-task-status") }}',
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

        // for show more and show less in details tab
        function showMore(element) {
            var more_details_div = element.previousElementSibling;
            more_details_div.style.display = "block";
            element.style.display = "none";
            element.nextElementSibling.style.display = "inline";
        }

        function showLess(element) {
            var more_details_div = element.previousElementSibling.previousElementSibling;
            more_details_div.style.display = "none";
            element.style.display = "none";
            element.previousElementSibling.style.display = "inline";
        }

        // for accept estimate modal
        function forAccept() {
            var name = $('#name').prop('checked')? 1:0;
            var address = $('#address').prop('checked')? 1:0;
            var home_phone = $('#home_phone').prop('checked')? 1:0;
            var mobile_phone = $('#mobile_phone').prop('checked')? 1:0;
            var email = $('#email').prop('checked')? 1:0;
            var projectid = {{ $project->id }};
            var tradeperson_id = {{ $estimate->tradesperson_id }};
            var estimateid = {{ $estimate->id }};
            let text = '{ "name": "' + name + '", "address": "' + address + '", "home_phone": "' + home_phone + '", "mobile_phone": "' + mobile_phone + '", "email": "' + email + '" }';
            const settings = JSON.parse(text);
            $.ajax({
                url: '{{ route("accept-estimation") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: 'project_started',
                    project_id : projectid,
                    tradesperson_id : tradeperson_id,
                    estimate_id : estimateid,
                    settings : settings
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'You have successfully accepted the estimate'
                    });
                    window.location.href = response.redirect_url;
                },
                error: function(xhr, error) {
                    // console.error('Error cancelling project:', error);
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops!! something went wrong',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }
        // for reject modal
        function reject() {
            var estimateid = {{ $estimate->id }};
            var projectid = {{ $project->id }};
            var tradeperson_id = {{ $estimate->tradesperson_id }};
            $.ajax({
                url: '{{ route("reject-estimation") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    estimate_id : estimateid,
                    project_id : projectid,
                    tradesperson_id : tradeperson_id
                },
                success: function(data) {
                    window.location.href = data.redirect_url;
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

        function disable() {
            if ($('#terms_of_service').is(':checked') && $('#clarified').is(':checked')) {
                $('#continue_').prop('disabled', false);
            } else {
                $('#continue_').prop('disabled', true);
            }
        }

        $(document).ready(function() {
            disable();
            let modal_video = $('#project_media_modal .modal-body video');
            let modal_image = $('#project_media_modal .modal-body img');

            $('#nav-details .pv_top img').on('click', function(){
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

            $('#nav-details .pv_top .video-mask video').on('click', function(){
                console.log('Clicking on Video');
                let video_url = $(this).attr('src');

                $('#project_media_modal').on('show.bs.modal', function(event){
                    modal_video.removeClass('hidden');
                    modal_video.attr('src', video_url);
                });

                $('#project_media_modal').modal('show');
            });
        });

    </script>

@endpush
