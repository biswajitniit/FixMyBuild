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
             <div class="col-md-9 dashboard_wrapper" id="mainContent">
               <div class="white_bg">
                    <form action="{{ route('tradesperson.savesettings') }}" method="post" id="notificationForm">
                        @csrf
                        <div class="row num_change trd_wp">
                            <div class="col-md-12">
                                <h3>I would like to receive notifications when:</h3>
                                <p>As a tradesperson:</p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch1" name="noti_new_quotes" value="1" {{ $notification['noti_new_quotes'] ? 'checked' : '' }}>
                                            <label for="switch1">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">New estimates are requested by customers</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                                <input type="checkbox" id="switch2" name="noti_quote_accepted" value="1" {{ $notification['noti_quote_accepted'] ? 'checked' : '' }}>
                                                <label for="switch2">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">Your estimate is accepted and, where applicable, upfront payment received</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                                <input type="checkbox" id="switch3" name="noti_project_stopped" value="1" {{ $notification['noti_project_stopped'] ? 'checked' : '' }}>
                                                <label for="switch3">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">When a customer stops a project</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch4" name="noti_quote_rejected" value="1" {{ $notification['noti_quote_rejected'] ? 'checked' : '' }}>
                                            <label for="switch4">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">When your estimate is rejected</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch5" name="noti_project_cancelled" value="1" {{ $notification['noti_project_cancelled'] ? 'checked' : '' }}>
                                            <label for="switch5">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">When a customer cancels a project before it starts</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                        <input type="checkbox" id="switch6" name="noti_new_message" value="1" {{ $notification['noti_new_message'] ? 'checked' : '' }}>
                                        <label for="switch6">Toggle</label>
                                    </div>
                                        <label class="form-check-label" for="mySwitch">I have received a new message</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch7" name="noti_share_contact_info" value="1" {{ $notification['noti_share_contact_info'] ? 'checked' : '' }}>
                                            <label for="switch7">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">I would like my company address and contact information to be publicly accessible so that customers can see if I am in their local area.</label>
                                    </div>
                                </div>
                                <!--//-->
                            </div>

                            <p>As a customer:</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch8" name="reviewed" value="1" {{ $notification['reviewed'] ? 'checked' : '' }}>
                                            <label for="switch8">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">My project has been reviewed</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch9" name="paused" value="1" {{ $notification['paused'] ? 'checked' : '' }}>
                                            <label for="switch9">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">My project has been paused</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                            <input type="checkbox" id="switch10" name="project_milestone_complete" value="1" {{ $notification['project_milestone_complete'] ? 'checked' : '' }}>
                                            <label for="switch10">Toggle</label>
                                        </div>
                                        <label class="form-check-label" for="mySwitch">A project milestone has been completed</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                        <input type="checkbox" id="switch11" name="project_complete" value="1" {{ $notification['project_complete'] ? 'checked' : '' }}>
                                        <label for="switch11">Toggle</label>
                                    </div>
                                        <label class="form-check-label" for="mySwitch">My project has been completed entirely</label>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <div class="switchToggle">
                                        <input type="checkbox" id="switch12" name="project_new_message" value="1" {{ $notification['project_new_message'] ? 'checked' : '' }}>
                                        <label for="switch12">Toggle</label>
                                    </div>
                                        <label class="form-check-label" for="mySwitch">I have received a new message</label>
                                    </div>
                                </div>
                                <!--//-->
                            </div>
                        </div>
                    </form>
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
                                <option>Other reasons</option>
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
        $(document).ready(function() {
            $('#switch1, #switch2, #switch3, #switch4, #switch5, #switch6, #switch7, #switch8, #switch9, #switch10, #switch11, #switch12').on('click', function(){
                // console.log('clicked');
                $('#notificationForm').submit();
            });
        });

        $('#notificationForm').submit(function(event) {
            event.preventDefault();
            $.post({
                url: "{{ route('tradesperson.savesettings') }}",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == 'error')
                        $('#mainContent').prepend('<p class="alert alert-danger">Something went wrong! Please refresh the page.</p>');
                },
                error: function(xhr, status, error) {
                    $('#mainContent').prepend('<p class="alert alert-danger">Something went wrong! Please refresh the page.</p>');
                }
            });
        });
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
