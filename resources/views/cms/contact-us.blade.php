@extends('layouts.app')

@section('content')
      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>Contact us</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->

      <!--Code area start-->
      <section class="pb-5">
        <div class="container">
            {{-- {!! $cms->cms_description !!} --}}
            <div class="row mb-5">
                <div class="col-md-10 offset-md-1">
                   <div class="contact-us-top">
                      <div class="row">
                          <div class="col-md-3 text-center"><img src="{{ asset("frontend/img/5 1.png") }}" alt=""></div>
                          <div class="col-md-9">
                              <h5>Our telephone number is <a href="tel:02081455102">0208 145 5102</a> and our normal business hours are 9 am to 5 pm UK time excluding Bank Holidays.</h5>
                              <h6>Outside of these times you can leave a voice message with us and we will contact you when we're next online.</h6>
                              <h5>Our email is: <a href="mailto:{{ env('COMPANY_MAIL') }}">{{ env('COMPANY_MAIL') }}</a></h5>
                          </div>
                      </div>
                   </div>
                   <div class="contact-us-bottom mt-5">
                      <div class="row">
                          <div class="col-md-6">
                              <h5>Our postal address</h5>
                              <h6>Our team work from our homes or remotely.</h6>
                          </div>
                          <div class="col-md-6">
                              <h3>Fix my build<br> PO Box 3335<br> Mitcham<br> CR4 9FQ</h3>
                          </div>
                      </div>
                   </div>
                </div>
            </div>
        </div>
     </section>
     <!--Code area end-->


@endsection
