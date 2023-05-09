@extends('layouts.app')

@section('content')

      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>Terms of Service</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Terms of Service</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->

     <section class="pb-5">
        <div class="container">
            {!! $cms->cms_description !!}
              <!--// END-->
        </div>
     </section>




@endsection
