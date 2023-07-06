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
                                <div class="bs-wizard-info text-center">25-12-22</div>
                            </div>
                            <div class="col bs-wizard-step complete">
                                <!-- complete -->
                                <div class="text-center bs-wizard-stepnum">View <br>estimates</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#" class="bs-wizard-dot"></a>
                                <div class="bs-wizard-info text-center">30-12-22</div>
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
                                <div class="bs-wizard-info text-center">05-01-23</div>
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
                            <div class="col-md-6"><h2>{{$projects->project_name}}</h2></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6"><h5>Location</h5></div>
                            <div class="col-md-6"><h2>{{$projectaddress->town_city}}</h2></div>
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
                                                @include('customer.tabs.nav-estimates')
                                                @include('customer.tabs.nav-profile')
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
                                <a href="#" class="btn btn-light mr-3">Cancel project</a>
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
                                <a href="{{ route('customer.project_review',[Hashids_encode($project_id)]) }}" class="btn btn-primary">Review</a>
                            @endif
                        </div>
                        {{-- Buttons Ends --}}
                    </div>
                </div>
               {{-- Different Tabs Ends --}}
               <!--// END-->
            </form>
         </div>

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

</script>
@endpush
