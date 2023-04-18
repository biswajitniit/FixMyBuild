@extends('layouts.app')

@section('content')
      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>About us</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About us</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->
    <section>
       <div class="container">
        {!! $cms->cms_description !!}
        </div>
    </section>

@endsection
