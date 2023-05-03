@extends('layouts.app')

@section('content')
<!--Code area start-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 fmb_titel">
                <h1>My profile</h1>
                <ol class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
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
            <div class="col-md-3 dashboard_sidebar">
                <ul>
                    <li><a href="{{ route('customer.profile') }}">Profile</a></li>
                    <li><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li class="active"><a href="{{ route('customer.notifications') }}">Settings</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="white_bg">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>I would like to receive notifications when:</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch3" checked/>
                                        <label for="switch3">Toggle</label>
                                    </div>
                                    <label class="form-check-label" for="mySwitch">My project has been reviewed</label>
                                </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch4" checked/>
                                        <label for="switch4">Toggle</label>
                                    </div>
                                    <label class="form-check-label" for="mySwitch">My project has been reviewed</label>
                                </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch5" checked/>
                                        <label for="switch5">Toggle</label>
                                    </div>
                                    <label class="form-check-label" for="mySwitch">A project milestone has been completed</label>
                                </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch1" />
                                        <label for="switch1">Toggle</label>
                                    </div>
                                    <label class="form-check-label" for="mySwitch">My project has been completed entirely</label>
                                </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <div class="switchToggle">
                                        <input type="checkbox" id="switch2" />
                                        <label for="switch2">Toggle</label>
                                    </div>
                                    <label class="form-check-label" for="mySwitch">I have received a new message</label>
                                </div>
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
