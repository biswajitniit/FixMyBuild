@extends('layouts.app')

@section('content')
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center pt-5 fmb_titel">
          <h1>My profile</h1>
          <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                <li @if(Route::is('tradepersion.dashboard')) class="active" @endif>
                   <a href="{{route('tradepersion.dashboard')}}">Profile</a>
                </li>
                <li @if(Route::is('tradepersion.projects')) class="active" @endif>
                   <a href="{{route('tradepersion.projects')}}">Projects</a>
                </li>
                <li @if(Route::is('tradepersion.settings')) class="active" @endif>
                   <a href="{{route('tradepersion.settings')}}">Settings</a>
                </li>
                <li>
                   <a href="javascript:void(0)">Logout</a>
                </li>
             </ul>
           </div>
             <div class="col-md-9  dashboard_wrapper">

               <div class="white_bg">
                   <div class="row num_change trd_wp">
                      <div class="col-md-12">
                         <h3>I would like to receive notifications when:</h3>
                         <p>As a tradesperson:</p>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch3">
                                 <label for="switch3">Toggle</label>
                             </div>
                              <label class="form-check-label" for="mySwitch">New estimates are requested by customers</label>
                           </div>
                        </div>
                        <!--//-->
                        <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch4">
                                 <label for="switch4">Toggle</label>
                             </div>
                              <label class="form-check-label" for="mySwitch">Your estimate is accepted and, where applicable, upfront payment received</label>
                           </div>
                        </div>
                        <!--//-->
                        <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch5">
                                 <label for="switch5">Toggle</label>
                             </div>
                              <label class="form-check-label" for="mySwitch">When a customer stops a project</label>
                           </div>
                        </div>
                        <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch1">
                                <label for="switch1">Toggle</label>
                            </div>
                             <label class="form-check-label" for="mySwitch">When your estimate is rejected</label>
                          </div>
                       </div>
                       <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch2">
                                <label for="switch2">Toggle</label>
                            </div>
                             <label class="form-check-label" for="mySwitch">When a customer cancels a project before it starts</label>
                          </div>
                       </div>
                       <!--//-->
                       <div class="col-md-12">
                         <div class="form-check form-switch">
                            <div class="switchToggle">
                               <input type="checkbox" id="switch32">
                               <label for="switch32">Toggle</label>
                           </div>
                            <label class="form-check-label" for="mySwitch">I have received a new message</label>
                         </div>
                      </div>
                      <!--//-->
                    </div>

                    <p>As a customer:</p>
                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch23">
                                <label for="switch23">Toggle</label>
                            </div>
                             <label class="form-check-label" for="mySwitch">My project has been reviewed</label>
                          </div>
                       </div>
                       <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch24">
                                <label for="switch24">Toggle</label>
                            </div>
                             <label class="form-check-label" for="mySwitch">My project has been paused</label>
                          </div>
                       </div>
                       <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch25">
                                <label for="switch25">Toggle</label>
                            </div>
                             <label class="form-check-label" for="mySwitch">A project milestone has been completed</label>
                          </div>
                       </div>
                       <!--//-->
                      <div class="col-md-12">
                         <div class="form-check form-switch">
                            <div class="switchToggle">
                               <input type="checkbox" id="switch21">
                               <label for="switch21">Toggle</label>
                           </div>
                            <label class="form-check-label" for="mySwitch">My project has been completed entirely</label>
                         </div>
                      </div>
                      <!--//-->
                      <div class="col-md-12">
                         <div class="form-check form-switch">
                            <div class="switchToggle">
                               <input type="checkbox" id="switch22">
                               <label for="switch22">Toggle</label>
                           </div>
                            <label class="form-check-label" for="mySwitch">I have received a new message</label>
                         </div>
                      </div>
                      <!--//-->

                   </div>
                   </div>
                </div>  <!--//-->

                <div class="white_bg mt-5 pcm-account">
                   <div class="row num_change">
                      <div class="col-md-12">
                         <h3>Please close my account</h3>
                      </div>
                      <div class="row">
                       <div class="col-md-12">
                        <form id="account_delete" action="{{ route('tradeperson.user-delete-account')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <p>Once your account is closed all of your information including the details of all of your projects will be permanently deleted.</p>
                            <h5>Please select the main reason for closing your account (Optional)</h5>
                            <div>
                                <select class="form-select" name="account_delete" required="">
                                <option>I'm not using this account anymore</option>
                                <option>I have another account</option>
                                <option>I want to create a new account</option>
                                <option>Account security concerns/Unauthorized activity</option>
                                <option>Privacy concerns</option>
                                <option>I have open issues with Fix my build</option>
                                <option>I have open issues with Fix my build</option>
                                </select>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="delete_permanently" value="1" name="delete_permanently" onclick="clickCheckBox()" required="">
                                <label class="form-check-label">Yes, I want to permanently close my Fix my build account and delete my data.</label>
                            </div>
                            <div class="form-group pre_ col-md-5 mt-3">
                                <button type="submit" id="submitted" class="btn btn-light" disabled>Close your account</button>
                            </div>
                        </form>
                        </div>
                        <!--//-->
                    </div>
                   </div>
                </div>  <!--//-->
             </div>
          </div>
          <!--// END-->
    </div>
 </section>
@push('scripts')
    <script>
        function clickCheckBox() {
            const checkbox = document.getElementById("delete_permanently");
            const button  = document.getElementById("submitted");
            if (checkbox.checked == false) {
                button.disabled = true;
            }
            else{
                  button.disabled = false;
            }

    }
    </script>
@endpush
@endsection
