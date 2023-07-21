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
                @include('customer.project_lists.new_project_list')
                @include('customer.project_lists.project_history_list')
            </div>
        </div>
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
