@extends('layouts.app')

@section('content')
<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12 text-center pt-5 fmb_titel">
             <h1>Company Registration</h1>
             <ol class="breadcrumb mb-5">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
       <form action="#" method="post">
          <div class="row">
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
                         <input type="text" class="form-control text-center font-24"  placeholder="20">
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
                                  <input type="radio" class="form-check-input mr-2" value="">Personal
                                  </label>
                               </div>
                               <div class="form-check-inline">
                                  <label class="form-check-label">
                                  <input type="radio" class="form-check-input mr-2" value="">Business
                                  </label>
                               </div>
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <input type="text" class="form-control pb-3"  placeholder="Account holder’s name">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-6">
                               <input type="text" class="form-control pb-3"  id="sortcode" placeholder="Sort code                   __                  __">
                            </div>
                            <div class="col-md-6">
                               <input type="text" class="form-control pb-3"  placeholder="Account number">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="check1" name="option1">
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
                                     <input type="checkbox" id="switch1">
                                     <label for="switch1">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When new quotes are requested</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch2">
                                     <label for="switch2">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your quote is accepted and, where applicable, upfront payment received</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch3">
                                     <label for="switch3">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When a project is stopped</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch4">
                                     <label for="switch4">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your quote is rejected</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch5">
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
                      <input class="form-check-input" type="checkbox" id="check1" name="option1">
                      <label class="form-check-label">Please confirm you have read and agree to our <a href="#">Terms & Conditions</a>.</label>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-4 mb-4 text-center pre_">
                   <button type="submit" class="btn btn-light">Previous</button>
                   <button type="submit" class="btn btn-primary">Submit</button>
                </div>
             </div>
          </div>
          <!--// END-->
       </form>
    </div>
 </section>
@push('scripts')

@endpush
@endsection