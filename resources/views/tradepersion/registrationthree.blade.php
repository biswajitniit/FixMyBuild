@extends('layouts.app')

@section('content')
<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Company Registration</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Company Registration</li>
             </ol>
          </div>
       </div>
    </div>
 </section>
 <!--Code area end-->
 <!--Code area start-->
 <section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center mb-5 fmb_titel">
             <h2>Contingency</h2>
          </div>
       </div>
    </div>
 </section>
 <section class="pb-5">
    <div class="container">

      @if($errors->any())
         <div class="alert alert-danger">
            <ul>
                  @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                  @endforeach
            </ul>
         </div>
      @endif

      @if(session()->has('message'))
         <div class="alert alert-success">
            {{ session()->get('message') }}
         </div>
      @endif
       <form action="{{route('tradepersion.savebankregistration')}}" method="post">
        @csrf
          <div class="row">
            @if (session('status'))
            <div class="col-md-10 offset-md-1 gen-info">
               <div class="row">
                  <div class="col-md-12">
                     <div class="alert alert-success" role="alert">
                        <h2 class="alert-heading">Great</h2>
                        <p>Your request has been successfully received.</p>
                        <hr>
                        <p class="mb-1">Your registration will be reviewed and our team will contact you if we need more information.</p>
                        <p><a href="{{route('home')}}" class="btn btn-primary">Continue</a></p>
                     </div>
                  </div>
               </div>
            </div>
            @endif
             <div class="col-md-10 offset-md-1">
                <div class="tell_about gen-info">
                   <div class="row">
                      <div class="col-md-12">
                         <p>Contingency is the amount, as a percentage of the total cost, that covers your <br> unexpected cost increases. This can be specified individually on each of your quotes. By default, the following percentage will be used.</p>
                      </div>
                   </div>
                   <div class="row mt-3">
                      <div class="col-7 col-md-3">
                         <h6>Default contingency</h6>
                      </div>
                      <div class="col-2">
                         <input type="text" name="contingency" class="form-control text-center font-24"  value="20">
                      </div>
                      <div class="col-2">
                         <h6 class="font-44">%</h6>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <!--// END-->
          <div class="row">
             <div class="col-md-10 offset-md-1">
                <section>
                   <div class="container">
                      <div class="row">
                         <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                            <h2>Bank account</h2>
                         </div>
                      </div>
                   </div>
                </section>
                <div class="white_bg">
                   <div class="row">
                      <div class="col-md-12">
                         <h3>Your bank account, where payments for projects will be sent.</h3>
                         <p>Type of  bank account</p>
                         <div class="row mt-4">
                            <div class="col-md-12">
                               <div class="form-check-inline mr-5">
                                  <label class="form-check-label">
                                  <input type="radio" class="form-check-input mr-2" name="bnk_account_type" value="Personal">Personal
                                  </label>
                               </div>
                               <div class="form-check-inline">
                                  <label class="form-check-label">
                                  <input type="radio" class="form-check-input mr-2" name="bnk_account_type" value="Business">Business
                                  </label>
                               </div>
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <input type="text" name="bnk_account_name" class="form-control pb-3"  placeholder="Account holder’s name">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-6">
                               <input type="text" class="form-control pb-3" name="bnk_sort_code"  id="sortcode" placeholder="Sort code                   __                  __">
                            </div>
                            <div class="col-md-6">
                               <input type="text" class="form-control pb-3" name="bnk_account_number"  placeholder="Account number">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="1" id="builder_amendment" name="builder_amendment">
                                  <label class="form-check-label">Builder registration page amendment</label>
                               </div>
                            </div>
                         </div>
                         <!--//-->
                      </div>
                   </div>
                </div>
                <!--//-->
                <section>
                   <div class="container">
                      <div class="row">
                         <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                            <h2>Notification</h2>
                         </div>
                      </div>
                   </div>
                </section>
                <div class="white_bg">
                   <div class="row">
                      <div class="col-md-12">
                         <h3>Send email notifications:</h3>
                         <div class="row">
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch1" name="noti_new_quotes" value="1" checked>
                                     <label for="switch1">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When new quotes are requested</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch2" name="noti_quote_accepted" value="1" checked>
                                     <label for="switch2">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your quote is accepted and, where applicable, upfront payment received</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch3" name="noti_project_stopped" value="1" checked>
                                     <label for="switch3">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When a project is stopped</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch4" name="noti_quote_rejected" value="1" checked>
                                     <label for="switch4">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your quote is rejected</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch5" name="noti_project_cancelled" value="1" checked>
                                     <label for="switch5">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When a project is cancelled before it starts</label>
                               </div>
                            </div>
                            <!--//-->
                         </div>
                      </div>
                   </div>
                </div>
                <!--//-->
                <div class="col-md-12 justify-content-center d-flex mt-4">
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms_and_condition" name="option1">
                      <label class="form-check-label">Please confirm you have read and agree to our <a href="{{ route('termspage', 1) }}">Terms & Conditions</a>.</label>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-4 mb-4 text-center pre_">
                   {{-- <a href="{{ route('tradepersion.compregistration') }}" class="btn btn-light">Previous</a> --}}
                   <button type="submit" class="btn btn-primary" id="form-submit-btn">Submit</button>
                </div>
             </div>
          </div>
          <!--// END-->
       </form>
    </div>
 </section>
@push('scripts')
<script>
    $(document).ready(function(){
        allowFormSubmission();
    });

    $("#terms_and_condition").change(function(){
        allowFormSubmission();
    });

    function allowFormSubmission() {
        if ($("#terms_and_condition").is(':checked')){
            $('#form-submit-btn').attr("disabled", false);
        } else {
            $('#form-submit-btn').attr("disabled", true);
        }
    }
</script>
@endpush
@endsection
