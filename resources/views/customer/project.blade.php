@extends('layouts.app')

@section('content')
<!--Code area start-->
<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>My profile</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Settings</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
<!--Code area end-->
@if( Auth::user()->is_email_verified === 0 )
    <section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="alert alert-warning" role="alert">
                    <span>
                        <svg width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.4987 0.916992L0.457031 28.6253H32.5404M16.4987 6.75033L27.4799 25.7087H5.51745M15.0404 12.5837V18.417H17.957V12.5837M15.0404 21.3337V24.2503H17.957V21.3337" fill="#EE5719"></path>
                        </svg>
                    </span>
                    Please Verify Your Email.
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="verify_mail">Resend Verification Link</button>
            </div>
        </div>
    </div>
    </section>
@else
@endif
<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li><a href="{{ route('customer.profile') }}">Profile</a></li>
                    <li class="active"><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li><a href="{{ route('customer.notifications.index') }}">Notifications</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="white_bg mb-5">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>
                                New project(s)
                                <span>
                                    <a @if(Auth::user()->is_email_verified == 0) href="javascript:void(0)" @else href="{{ route('customer.newproject') }}" @endif> <i class="fa fa-plus"></i> Add new</a>
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
                                   @if ($project)
                                        @php
                                            $count = 1;
                                        @endphp
                                       @foreach ($project as $row)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ ucwords($row->project_name) }}</td>
                                                <td>{{ date('d/m/Y',strtotime($row->created_at))}} <br> <em> {{ date('h:i a',strtotime($row->created_at))}} </em> </td>
                                                <td>
                                                    @switch($row->status)
                                                        @case('submitted_for_review')
                                                            <span class="text-info">Submitted for review</span>
                                                            @break
                                                        @case('returned_for_review')
                                                            <span class="text-dark">Returned for review</span>
                                                            @break
                                                        @case('estimation')
                                                            <span class="text-primary">View estimates</span>
                                                            @break
                                                        @case('project_started')
                                                            <span class="text-success">Project started</span>
                                                            @break
                                                        @case('awaiting_your_review')
                                                            <span class="text-awaiting">Awaiting your feedback</span>
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    @if ($row->status === 'project_started')
                                                        <a href="#"><img src="{{ asset('frontend/img/chat-info.svg') }}" alt=""></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->status === 'awaiting_your_review')
                                                    <a href="{{route('customer.project_review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                                    @else
                                                    <a href="{{route('customer.project_details',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                                        {{-- <a href="{{route('customer.project-return-for-review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a> --}}
                                                    @endif
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                   @endif


                                </tbody>
                             </table>
                        </div>
                    </div>
                </div>
                <!--//-->
                <div class="white_bg">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>Project history</h3>
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
                                    @if ($project)
                                         @php
                                             $count = 1;
                                         @endphp
                                        @foreach ($projecthistory as $row)
                                             <tr>
                                                 <td>{{ $count }}</td>
                                                 <td>{{ ucwords($row->project_name) }}</td>
                                                 <td>{{ date('d/m/Y',strtotime($row->created_at))}} <br> <em> {{ date('h:i a',strtotime($row->created_at))}} </em> </td>
                                                 <td>
                                                    @switch($row->status)
                                                        @case('project_cancelled')
                                                            <span class="text-danger">Project Cancelled</span>
                                                            @break
                                                        @case('project_paused')
                                                            <span class="text-warning">Project Paused</span>
                                                            @break
                                                        @case('project_completed')
                                                            <span class="text-success">Project Completed</span>
                                                            @break
                                                    @endswitch
                                                 </td>
                                                 <td></td>
                                                 <td>
                                                     @if ($row->status === 'project_completed')
                                                     <a href="{{route('customer.project_review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                                     @else
                                                     <a href="{{route('customer.project_details',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                                         {{-- <a href="{{route('customer.project-return-for-review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a> --}}
                                                     @endif
                                                 </td>
                                             </tr>
                                             @php
                                                 $count++;
                                             @endphp
                                         @endforeach
                                    @endif


                                 </tbody>
                             </table>
                        </div>
                    </div>
                </div>
                <!--//-->
            </div>
        </div>
        <!--// END-->
    </div>
</section>
<!--Code area end-->

@push('scripts')
<script>
$("#verify_mail").click(function(){
    $.ajax({
        url: "{{ route('customer.resend_verification_email')}}",
                data: {'_token': "{{ csrf_token() }}"},
                method: 'POST',
                success: function(data){
                    alert(data);
            }});
});
</script>
@endpush

@endsection
