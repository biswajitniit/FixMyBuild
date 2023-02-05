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
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                    <li class="active"><a href="{{ route('customer.project') }}">Projects</a></li>
                    <li><a href="{{ route('customer.notifications') }}">Notifications</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </div>
            <div class="col-md-9 dashboard_wrapper">
                <div class="white_bg mb-5">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>
                                New project(s)
                                <span>
                                    <a href="{{ route('customer.newproject') }}"> <i class="fa fa-plus"></i> Add new</a>
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="row table_wrap">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Sl</th>
                                        <th style="width: 150px;">Name</th>
                                        <th style="width: 250px;">Category</th>
                                        <th style="width: 150px;">Posting date</th>
                                        <th style="width: 300px;">Status</th>
                                        <th style="width: auto;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-info">Submitted for review</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-dark">Returned for review</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-primary">View estimates</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>04</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-success">Project started</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--//-->
                <div class="white_bg">
                    <div class="row num_change">
                        <div class="col-md-12">
                            <h3>Project history</h3>
                        </div>
                    </div>
                    <div class="row table_wrap">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Sl</th>
                                        <th style="width: 150px;">Name</th>
                                        <th style="width: 250px;">Category</th>
                                        <th style="width: 150px;">Posting date</th>
                                        <th style="width: 300px;">Status</th>
                                        <th style="width: auto;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-success">Project completed</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-success">Project completed</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-danger">Project paused</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>04</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-danger">Project paused</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>05</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-success">Project completed</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>06</td>
                                        <td>Modern bathroom</td>
                                        <td>
                                            Bathrooms <br />
                                            Bathroom Designer
                                        </td>
                                        <td>
                                            02/01/2023 <br />
                                            11:12 am
                                        </td>
                                        <td class="text-success">Project completed</td>
                                        <td><a href="#" class="btn btn-view">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--//-->
            </div>
        </div>
        <!--// END-->
    </div>
</section>
<!--Code area end-->




@endsection
