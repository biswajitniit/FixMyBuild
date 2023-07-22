@extends('layouts.app')

@section('content')
      <!--Code area start-->
      <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center pt-5 fmb_titel">
                  <h1>Notifications</h1>
                  <ol class="breadcrumb mb-5">
                     <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('customer.notifications.index') }}">Notifications</a></li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <!--Code area end-->
      <!--Code area start-->
      <section class="pb-5">
            <div class="container">
               <div class="row">
                    <div class="col-md-12 dashboard_wrapper">
                        <div class="white_bg mb-5">
                            <div class="row num_change">
                                <div class="col-md-12 mb-4">
                                <h3>View all notifications</h3>
                                </div>
                                <div class="row">
                                    <div class="all-notificaion">
                                        @if($unread_notifications === 0)
                                            <p><b>No Notification Available For You Right Now.</b></p>
                                        @else
                                            <div class="row mb-3">
                                                @foreach($notifications as $notification)
                                                    <div class="col-md-1 col-3 pr-0 mt-3" >
                                                        <img src="{{ asset("images/notification_user.png") }}" alt="" class="notification-user-img">
                                                    </div>
                                                    <div class="col-md-11 col-9 pl-0 mt-3">
                                                        <h5>{{ ucwords($notification->notification_text) }}</h5>
                                                        <h6>{{ time_diff($notification->created_at) }}</h6>
                                                        <p>{{ ucwords($notification->reviewer_note) }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <!--//-->
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <!--// END-->
            </div>
      </section>
      <!--Code area end-->
@endsection
    @push('script')
      <!-- <script></script> -->
        <script>
            var input = document.querySelector("#phone");
            window.intlTelInput(input, {
                separateDialCode: true,
                //  excludeCountries: ["gb"],
                preferredCountries: ["gb"]
            });

            $('#summernote').summernote({
            placeholder: 'FixMyBuild',
            tabsize: 2,
            height: 200
            });

            function toggleDropdown(el) {
            el.siblings('.dropdown-block').first().toggleClass('display-block');
            }
        </script>
    @endpush
