@extends('layouts.app')

@section('content')

    <!--Code area start-->
    <section class="pb-5">
        <div class="container">
            {{-- {!! $cms->cms_description !!} --}}
            <!--Banner area start-->
            <section class="banner-inner">
                <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 position-relative order-2 order-xl-1 order-lg-1 order-md-1 order-sm-2">
                        <div class="pt-lg-5 pt-sm-1 pb-4 text-middel h-100">
                            <h2 class="pt-md-3 pt-sm-1 font-64 font-weight-bold">Good quality work at sensible prices</h2>
                            <p>Coming soon!</p>
                            <div class="price-display mt-4">
                            <!--<a class="btn mr-3" href="new-customer.html">Start your project</a>
                            <a class="btn mr-3 cy-project" href="sign-in.html">Continue your project</a>-->
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 text-center order-1 order-xl-2 order-lg-2 order-md-2 order-sm-1">
                        <div class="img">
                            <img src="{{ asset("frontend/img/under_construction.png") }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                </div>
            </section>
            <!--THIS COURSE INCLUDES area end-->
        </div>
    </section>
    <!--Code area end-->


@endsection
