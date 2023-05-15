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
                <li class="active"><a href="{{ route('customer.profile') }}">Profile</a></li>
                <li><a href="{{ route('customer.project') }}">Projects</a></li>
                <li><a href="{{ route('customer.notifications.index') }}">Notifications</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
               </ul>
           </div>
        <div class="col-md-9  dashboard_wrapper">

               <div class="white_bg">
                   <div class="row num_change">
                      <div class="col-md-12">
                         <h3>I would like to receive notifications when:</h3>
                      </div>
                      <div class="row">
                    <form id="settings-form">
                       <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch3" onChange="toggle();" value="1" name ='project_reviewed'>
                                 <label for="switch3">Toggle</label>
                              </div>
                              <label class="form-check-label" for="mySwitch">My project has been reviewed</label>
                           </div>
                        </div>
                        <!--//-->
                        <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch4" onChange="toggle();" value="1" name ='project_paused'>
                                 <label for="switch4">Toggle</label>
                              </div>
                              <label class="form-check-label" for="mySwitch">My project has been paused</label>
                           </div>
                        </div>
                        <!--//-->
                        <div class="col-md-12">
                           <div class="form-check form-switch">
                              <div class="switchToggle">
                                 <input type="checkbox" id="switch5" onChange="toggle();" value="1" name ='project_milestone_complete'>
                                 <label for="switch5">Toggle</label>
                              </div>
                              <label class="form-check-label" for="mySwitch">A project milestone has been completed</label>
                           </div>
                        </div>
                        <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch1" onChange="toggle();" value="1" name ='project_completed'>
                                <label for="switch1">Toggle</label>
                             </div>
                             <label class="form-check-label" for="mySwitch">My project has been completed entirely</label>
                          </div>
                       </div>
                       <!--//-->
                       <div class="col-md-12">
                          <div class="form-check form-switch">
                             <div class="switchToggle">
                                <input type="checkbox" id="switch2" onChange="toggle();" value="1" name ='project_new_message'>
                                <label for="switch2">Toggle</label>
                             </div>
                             <label class="form-check-label" for="mySwitch">I have received a new message</label>
                          </div>
                       </div>
                       <input type="hidden" id='userid' value="{{ Auth::user()->id }}"/>
                       <!--//-->

                    </form>
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
                         <form id="account_delete" action="{{ route('user.user-delete-account')}}" method="post">
                            @csrf
                            @method('DELETE')
                         <p>Once your account is closed all of your information including the details of all of your projects will be permanently deleted.</p>
                         <h5>Please select the main reason for closing your account (Optional)</h5>
                         <div>
                            <select class="form-select">
                               <option>I'm not using this account anymore</option>
                               <option>I have another account</option>
                               <option>I want to create a new account</option>
                               <option>Account security concerns/Unauthorized activity</option>
                               <option>Privacy concerns</option>
                               <option>I have open issues with Fix my build</option>
                               <option>I have open issues with Fix my build</option>
                             </select>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check1" name="option1" required="">
                            <label class="form-check-label">Yes, I want to permanently close my Fix my build account and delete my data.</label>
                          </div>
                          <div class="form-group pre_ col-md-5 mt-3">
                            <button type="submit" class="btn btn-light">Close your account</button>
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
 <!--Code area end-->

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajax({
            url: '{{ route('notifications.data_fetch') }}',
            data: {'_token': "{{ csrf_token() }}"},
            method: 'POST',
            success: function(data) {
                var setting = data.message.settings;
                var switch1 = document.getElementById('switch3')
                var switch2= document.getElementById('switch4')
                var switch3= document.getElementById('switch5')
                var switch4= document.getElementById('switch1')
                var switch5= document.getElementById('switch2')
                switch1.checked=setting.reviewed==1?true:false
                switch2.checked=setting.paused==1?true:false
                switch3.checked=setting.project_milestone_complete==1?true:false
                switch4.checked=setting.project_complete==1?true:false
                switch5.checked=setting.project_new_message==1?true:false
            }
        })
    });

    function toggle(){
        var switch1 = document.getElementById('switch3').checked?1:0
        var switch2= document.getElementById('switch4').checked?1:0
        var switch3= document.getElementById('switch5').checked?1:0
        var switch4= document.getElementById('switch1').checked?1:0
        var switch5= document.getElementById('switch2').checked?1:0
        var userid=document.getElementById('userid').value
        let text = '{ "reviewed":'+ switch1 +', "paused":'+ switch2  +', "project_milestone_complete":'+ switch3 +', "project_complete":'+ switch4 +',"project_new_message":'+ switch5+' }';
        const settings = JSON.parse(text);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route('notifications.data_store') }}',
            data: {'settings':settings,'userid':userid,'_token': "{{ csrf_token() }}"},
            method: 'POST',
            success: function(data) {
            }
        })
    }
</script>
@endpush
