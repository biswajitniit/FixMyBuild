@extends('layouts.app')

@section('content')

      <!--Code area start-->
      <section>
        <div class="container">
           <div class="row">
              <div class="col-md-12 text-center pt-5 fmb_titel">
                 <h1>Privacy policy</h1>
                 <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Privacy policy</li>
                 </ol>
              </div>
           </div>
        </div>
     </section>
     <!--Code area end-->

      <!--Code area start-->
      <section class="pb-5">
        <div class="container">
            {!! $cms->cms_description !!}
              <!--// END-->
        </div>
     </section>
     <!--Code area end-->




@endsection
