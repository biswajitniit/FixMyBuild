@extends('layouts.app')

@section('content')
<!--Code area start-->
<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>My profile</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Projects</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
<!--Code area end-->
<!--Code area start-->
<section class="pb-5">
    <div class="container">
        <div @class([
            'row',
            'mt-5' => !Auth::user()->is_email_verified,
        ])>
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li><a href="{{ route('customer.profile') }}">Profile</a></li>
                    <li class="active"><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li><a href="{{ route('customer.notifications.index') }}">Notifications</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                @include('customer.includes.verify-email')
                @include('customer.project_lists.new_project_list')
                @include('customer.project_lists.project_history_list')
            </div>
        </div>
    </div>
</section>
<!--Code area end-->

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$("#verify_mail").click(function(){
    $.ajax({
        url: "{{ route('customer.resend_verification_email')}}",
        data: {'_token': "{{ csrf_token() }}"},
        method: 'POST',
        success: function(data){
            Swal.fire({
                icon: 'success',
                title: data,
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
});
</script>
@endpush

@endsection
