@extends('layouts.app')

@section('content')

      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>Terms & Conditions</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->

     <section class="pb-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-3 dashboard_sidebar term_">
                            <ul>
                                {{-- <li class="active"><a href="#">Summary</a></li>
                                <li><a href="#">Website Terms and Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Cookie Policy </a></li>
                                <li><a href="#">Acceptable Use Policy</a></li> --}}
                                @if($termspagename)
                                    @foreach ($termspagename as $rowtermspagename)
                                        <li @if($rowtermspagename->id == Request::segment(2)) class="active" @endif><a href="{{ route('termspage',[$rowtermspagename->id]) }}">{{ $rowtermspagename->name }}</a></li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                        <div class="col-md-9">
                            {!! $terms->terms_description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection
