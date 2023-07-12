@extends('layouts.app')

@section('content')
<!--Code area start-->

<!-- Modal Type 1 START-->
<div class="modal fade select_address" id="project_media_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-0">

                <h5 class="modal-title" id="exampleModalLabel"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                            fill="black"
                        />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 supported_">
                        <img src="" alt="" />
                        <video controls="controls" src=""> </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Type 1 END-->

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

    <!--Code area end-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    @if($errors->any())
                        <div class="alert alert-danger mt-15">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success mt-15">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    @if(session()->has('danger'))
                        <div class="alert alert-danger mt-15">
                            {{ session()->get('danger') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--Code area start-->

      <!--Code area start-->
      <section class="pb-5">
         <div class="container">
            <form action="{{route('customer.project-all-payment')}}" method="post" name="project-all-payment" id="project-all-payment">
                <input type="hidden" name="estimates_id" value="{{$estimates->id}}">
                @csrf
                @php
                    $status=$projects->status;
                @endphp

                {{-- Project Timeline Widgets Starts --}}
                @if ($status == 'project_started' || $status == 'awaiting_your_review')
                    <div class="row mb-5">
                        <div class="col-md-10 offset-md-1">
                        <div class="bs-wizard row">
                            <div class="col bs-wizard-step complete">
                                <div class="text-center bs-wizard-stepnum">Submitted <br> for review</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">{{ date('d-m-y', strtotime($projects->created_at)) }}</div>
                            </div>
                                <div class="col bs-wizard-step complete">
                                    <!-- complete -->
                                    <div class="text-center bs-wizard-stepnum">View <br>estimates</div>
                                    <div class="progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                    <a href="#" class="bs-wizard-dot"></a>
                                    @foreach($proj_logs as $proj_log)
                                        @if ($proj_log->action_by_type == 'reviewer' && $proj_log->status == 'approved')
                                            <div class="bs-wizard-info text-center">{{ date('d-m-y', strtotime($proj_log->status_changed_at)) }}</div>
                                        @endif
                                    @endforeach
                                </div>
                                @if($status == 'awaiting_your_review')
                                    <div class="col bs-wizard-step complete">
                                @else
                                    <div class="col bs-wizard-step closed">
                                @endif
                                    <!-- complete -->
                                    <div class="text-center bs-wizard-stepnum">Project started</div>
                                    <div class="progress">
                                        <div class="progress-bar"></div>
                                    </div>
                                    <a href="#" class="bs-wizard-dot"></a>
                                    @foreach($proj_logs as $proj_log)
                                        @if($proj_log->action_by_type == 'user' && $proj_log->status == 'project_started')
                                            <div class="bs-wizard-info text-center">{{ date('d-m-y', strtotime($proj_log->status_changed_at)) }}
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            @if($status == 'awaiting_your_review')
                                <div class="col bs-wizard-step closed">
                            @else
                                <div class="col bs-wizard-step disabled">
                            @endif
                                <!-- active -->
                                <div class="text-center bs-wizard-stepnum">Milestones <br>completed</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                            <div class="col bs-wizard-step disabled">
                                <!-- active -->
                                <div class="text-center bs-wizard-stepnum">Project <br>completed</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endif
                {{-- Project Timeline Widgets Ends --}}
               <div class="row mb-5">
                  <div class="col-md-10 offset-md-1">
                     <div class="tell_about pl-details">
                        <div class="row">
                            <div class="col-md-6"><h5>Customer’s project name</h5></div>
                            <div class="col-md-6"><h2>{{ ucwords($projects->project_name) }}</h2></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6"><h5>Location</h5></div>
                            <div class="col-md-6">
                                <h2>
                                    @if ($projects->postcode){{ $projects->postcode.', ' }} @endif @if ($projects->town){{ $projects->town.', ' }}@endif @if ($projects->county){{ $projects->county }}@endif
                                </h2>
                            </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--// END-->

                {{-- Dynamic Details Starts --}}
                {{-- <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="card card-wrap">
                            <div class="card-header">Details</div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-8"><h6>Status: <span class="text-info">{{$status}}</h6></div>
                                    <div class="col-md-4 text-right"><h6>Posted on: <span class="date_time">{{ $projects->created_at->format('d M Y,  H:i A') }}</span> </h6></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                            {{htmlspecialchars(trim(strip_tags($projects->description )))}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h3>Photo(s)/Video(s)</h3>
                                    <div class="row">
                                        <div class="pv_top">
                                            @foreach($doc as $docs)
                                                @if($docs->file_type=='video'||$docs->file_type=='image')

                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#profile_pics"><img src="{{$docs->url}}" alt=""  width="150" height="0"  /></a>


                                                    <!-- The Modal Change profile photo-->
                                                    <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header pb-0">

                                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>

                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                                                fill="black"
                                                                            />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 supported_">
                                                                            <div>
                                                                                <img src="{{$docs->url}}" alt="" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- The Modal Change profile photo END-->
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <h3>Files(s)</h3>

                                    <div class="row">
                                        <div class="mt-2">
                                            @foreach($doc as $docs)
                                                @if($docs->file_type=='document')
                                                    <div class="d-inline mr-4 img-text"><a href="{{$docs->url}}" target="_blank"><img src="" alt="">{{$docs->filename}}</a></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 mt-5 text-center">
                            <a href="{{url('/customer/projects')}}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div> --}}
                {{-- Dynamic Details Ends --}}

               {{-- Different Tabs Starts --}}
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row mb-5">
                            <div class="col-12 tab_wrap milestone_">
                                <div class="card card-wrap">
                                    <div class="card-header">
                                    <nav>
                                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                            @if ($status == 'submitted_for_review')
                                                <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Details</a>
                                            @elseif ($status == 'estimation')
                                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Estimate</a>
                                                <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                                            @elseif ($status == 'project_started' || $status == 'awaiting_your_review')
                                                <a class="nav-item nav-link active" id="nav-milestones-tab" data-toggle="tab" href="#nav-milestones" role="tab" aria-controls="nav-milestones" aria-selected="true">Milestones</a>
                                                <a class="nav-item nav-link" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="false">Details</a>
                                                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="false">Estimate</a>
                                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About company</a>
                                                <a class="nav-item nav-link" id="nav-chat-tab" data-toggle="tab" href="#nav-chat" role="tab" aria-controls="nav-chat" aria-selected="false">Chat <span class="badge badge-secondary">2</span></a>
                                            @endif
                                        </div>
                                    </nav>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            {{-- Dynamic Div Starts --}}
                                            @include('customer.tabs.nav-details')
                                            @if ($status == 'estimation')
                                                @include('customer.tabs.nav-estimates')
                                            @elseif ($status == 'project_started' || $status == 'awaiting_your_review')
                                                @include('customer.tabs.nav-milestones')
                                                @include('customer.estimate_tab')
                                                @include('customer.about-company')
                                                @include('customer.tabs.nav-chat')
                                            @endif
                                            {{-- Dynamic Div Ends --}}





                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Buttons Starts --}}
                        <div class="form-group col-md-12 mt-5 text-center pre_">
                            @if ($status == 'estimation')
                                <a href="javascript:void(0);" class="btn btn-light mr-3" data-bs-toggle="modal" data-bs-target="#cancel_project">Cancel project</a>
                                <a href="{{url('/customer/projects')}}" class="btn btn-primary">Back</a>
                            @else
                                <a href="{{url('/customer/projects')}}" class="btn btn-light mr-3">Back</a>
                            @endif
                            @if ($status == 'project_started')
                                <a href="project-details-view-estimates.html" class="btn btn-light mr-3">Pause project </a>
                                {{-- <a href="#" class="btn btn-primary">Pay all</a> --}}

                                {{-- <input type="submit" class="btn btn-primary" value="Pay all" data-key="pk_test_zeGoVEfpYZ93rNF9hwHUVY4r00DWWCoAJT" data-amount="500" data-currency="inr" data-name="Fixmybuild" data-description="" /> --}}

                                @php
                                $total_task_price = 0;
                                @endphp
                                @foreach ($task as $row)

                                        @php
                                            if ($row->payment_status != 'succeeded'){
                                                $total_task_price =  $total_task_price+($row->price + $row->contingency);
                                            }
                                        @endphp
                                @endforeach
                                @php
                                    $total_payble_amount =  round(((($total_task_price * 5) / 100)) + 195.20 +  $total_task_price);
                                @endphp


                                <input type="hidden" name="totalamount" value="{{ round(((($total_task_price * 5) / 100)) + 195.20 +  $total_task_price) }}">
                                <input
                                    type="submit"
                                    class="btn btn-primary"
                                    value="Pay all"
                                    data-key="{{env('STRIPE_KEY')}}"
                                    data-amount="{{ round((((($total_task_price * 5) / 100)) + 195.20 +  $total_task_price) * 100) }}"
                                    data-currency="gbp"
                                    data-name="Fixmybuild"
                                    data-description=""
                                />

                            @endif
                            @if ($status == 'awaiting_your_review')
                                <a href="{{ route('customer.project_review',[Hashids_encode($projects->id)]) }}" class="btn btn-primary">Review</a>
                            @endif
                            @if ($status == 'submitted_for_review')
                                <a href="{{ route('customer.project_review',[Hashids_encode($projects->id)]) }}" class="btn btn-primary">Review</a>
                            @endif
                        </div>
                        {{-- Buttons Ends --}}
                    </div>
                </div>
               {{-- Different Tabs Ends --}}
               <!--// END-->
            </form>
         </div>
         <!-- Cancel Project Modal -->
        <div class="modal fade select_address" id="cancel_project" tabindex="-1" aria-labelledby="deleteImageModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                    <svg width="73" height="73" viewBox="0 0 73 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M36.5 0C29.281 0 22.2241 2.14069 16.2217 6.15136C10.2193 10.162 5.54101 15.8625 2.77841 22.532C0.0158149 29.2015 -0.707007 36.5405 0.701354 43.6208C2.10971 50.7011 5.586 57.2048 10.6906 62.3094C15.7952 67.414 22.2989 70.8903 29.3792 72.2986C36.4595 73.707 43.7984 72.9842 50.4679 70.2216C57.1374 67.459 62.838 62.7807 66.8486 56.7783C70.8593 50.7759 73 43.719 73 36.5C72.9907 26.8224 69.1422 17.5439 62.2991 10.7009C55.4561 3.8578 46.1776 0.00929194 36.5 0ZM36.5 67.3846C30.3916 67.3846 24.4204 65.5732 19.3414 62.1796C14.2625 58.786 10.3039 53.9624 7.96635 48.319C5.62877 42.6756 5.01715 36.4657 6.20884 30.4747C7.40053 24.4837 10.342 18.9806 14.6613 14.6613C18.9806 10.342 24.4837 7.40051 30.4747 6.20882C36.4657 5.01713 42.6756 5.62875 48.319 7.96633C53.9625 10.3039 58.786 14.2625 62.1796 19.3414C65.5733 24.4204 67.3846 30.3916 67.3846 36.5C67.3753 44.6882 64.1184 52.5385 58.3285 58.3284C52.5385 64.1184 44.6883 67.3753 36.5 67.3846ZM40.7115 54.75C40.7115 55.583 40.4645 56.3972 40.0018 57.0898C39.539 57.7824 38.8812 58.3222 38.1117 58.6409C37.3421 58.9597 36.4953 59.0431 35.6784 58.8806C34.8614 58.7181 34.111 58.317 33.522 57.728C32.933 57.139 32.5319 56.3886 32.3694 55.5716C32.2069 54.7547 32.2903 53.9079 32.6091 53.1383C32.9278 52.3687 33.4676 51.711 34.1602 51.2482C34.8528 50.7855 35.667 50.5384 36.5 50.5384C37.617 50.5384 38.6882 50.9822 39.478 51.772C40.2678 52.5618 40.7115 53.633 40.7115 54.75ZM49.1346 29.4808C49.1346 32.3437 48.1623 35.1218 46.3769 37.3599C44.5916 39.5979 42.0991 41.1633 39.3077 41.7995V42.1154C39.3077 42.86 39.0119 43.5742 38.4853 44.1007C37.9588 44.6273 37.2447 44.9231 36.5 44.9231C35.7554 44.9231 35.0412 44.6273 34.5147 44.1007C33.9881 43.5742 33.6923 42.86 33.6923 42.1154V39.3077C33.6923 38.563 33.9881 37.8489 34.5147 37.3223C35.0412 36.7958 35.7554 36.5 36.5 36.5C37.8883 36.5 39.2454 36.0883 40.3997 35.317C41.554 34.5458 42.4537 33.4495 42.9849 32.1669C43.5162 30.8843 43.6552 29.473 43.3844 28.1114C43.1135 26.7498 42.445 25.4991 41.4634 24.5174C40.4817 23.5358 39.231 22.8672 37.8694 22.5964C36.5078 22.3256 35.0965 22.4646 33.8139 22.9958C32.5313 23.5271 31.435 24.4268 30.6637 25.5811C29.8924 26.7354 29.4808 28.0925 29.4808 29.4808C29.4808 30.2254 29.185 30.9396 28.6584 31.4661C28.1319 31.9926 27.4177 32.2885 26.6731 32.2885C25.9284 32.2885 25.2143 31.9926 24.6877 31.4661C24.1612 30.9396 23.8654 30.2254 23.8654 29.4808C23.8654 26.1299 25.1965 22.9162 27.566 20.5467C29.9354 18.1773 33.1491 16.8461 36.5 16.8461C39.8509 16.8461 43.0646 18.1773 45.434 20.5467C47.8035 22.9162 49.1346 26.1299 49.1346 29.4808Z" fill="#061A48"/>
                        </svg>
                        <h5>Cancel Project</h5>
                        <p>Are you sure you want to permanently cancel this project?</p>
                        <h4 class="text-danger"></h4>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light"  onclick="cancelProject()" id="confirmedDelete">Yes</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cancel Project Modal END -->
         <input type="hidden" value="{{ $projects->id }}" id="projectid"/>
      </section>


      <!--Code area end-->
@endsection

@push('scripts')
<script src="https://checkout.stripe.com/v2/checkout.js"></script>

<script>
$(document).ready(function() {
    $(':submit').on('click', function(event) {
        event.preventDefault();
        var $button = $(this),
            $form = $button.parents('form');
        var opts = $.extend({}, $button.data(), {
            token: function(result) {
                $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
            }
        });
        StripeCheckout.open(opts);
    });
});
</script>
<script>
    $(function(){
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
            let video_url = $(this).find('source').attr('src');
            console.log(video_url);

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

    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    function customerFeedbackInfo() {
        if ($('#myPopup').hasClass( "show" )){
            $('#myPopup').hide();
        } else {
            $('#myPopup').show();
        }

        $('#myPopup').toggleClass("show");
    }

    // When the user hovers on tooltip, open the popup
    $('#customer_feedback_tooltip').hover(function(e) {
        customerFeedbackInfo();
    });

    function confirmDeletePopup(file, divId){
        $('#cancel_project').modal('show');
    }

    function cancelProject() {
        var projectid=$('#projectid').val();
        $.ajax({
            url: '{{ route("cancel-project") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: 'project_cancelled',
                project_id : projectid
            },
            success: function(response) {
                // console.log('Project cancelled successfully');
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                console.error('Error cancelling project:', error);
            }
        });
    }

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


</script>
@endpush
