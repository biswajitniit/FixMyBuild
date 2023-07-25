@extends('layouts.app')

@section('content')
<section>
    <div class="modal fade select_address" id="successRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <svg width="83" height="83" viewBox="0 0 83 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_519_1019)">
                        <path d="M41.5002 4.61133C34.2043 4.61133 27.0722 6.77482 21.0059 10.8282C14.9395 14.8816 10.2114 20.6429 7.41934 27.3834C4.62731 34.124 3.89679 41.5411 5.32015 48.6969C6.74352 55.8526 10.2568 62.4256 15.4159 67.5846C20.5749 72.7436 27.1478 76.2569 34.3036 77.6803C41.4593 79.1037 48.8764 78.3731 55.617 75.5811C62.3576 72.7891 68.1188 68.0609 72.1722 61.9946C76.2256 55.9282 78.3891 48.7962 78.3891 41.5002C78.3891 31.7167 74.5026 22.3338 67.5846 15.4158C60.6666 8.49783 51.2838 4.61133 41.5002 4.61133ZM41.5002 73.778C35.1163 73.778 28.8757 71.8849 23.5677 68.3382C18.2596 64.7915 14.1225 59.7504 11.6795 53.8524C9.23643 47.9544 8.59722 41.4644 9.84266 35.2031C11.0881 28.9419 14.1623 23.1905 18.6764 18.6764C23.1905 14.1623 28.9419 11.0881 35.2032 9.84265C41.4644 8.5972 47.9544 9.23641 53.8524 11.6794C59.7504 14.1225 64.7915 18.2596 68.3382 23.5676C71.885 28.8757 73.778 35.1163 73.778 41.5002C73.778 50.0608 70.3773 58.2708 64.3241 64.3241C58.2708 70.3773 50.0608 73.778 41.5002 73.778Z" fill="#061A48"/>
                        <path d="M64.5554 27.897C64.1235 27.4676 63.5391 27.2266 62.93 27.2266C62.3209 27.2266 61.7366 27.4676 61.3046 27.897L35.7129 53.3734L21.8796 39.5401C21.4577 39.0845 20.8721 38.8152 20.2516 38.7914C19.6312 38.7677 19.0267 38.9913 18.5711 39.4133C18.1156 39.8352 17.8463 40.4208 17.8225 41.0412C17.7987 41.6617 18.0224 42.2662 18.4443 42.7217L35.7129 59.9442L64.5554 31.1709C64.7715 30.9566 64.9431 30.7016 65.0601 30.4206C65.1772 30.1397 65.2374 29.8383 65.2374 29.5339C65.2374 29.2296 65.1772 28.9282 65.0601 28.6473C64.9431 28.3663 64.7715 28.1113 64.5554 27.897Z" fill="#061A48"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_519_1019">
                        <rect width="83" height="83" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                    <h5 class="mb-4 mt-2">Great!</h5>
                    <h4 class="mb-3">Your request has been successfully received.</h4>
                    <p class="text-muted">Your registration will be reviewed and our team will contact you if we need more information.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <a href={{ route('tradepersion.dashboard') }} class="btn btn-light">Continue</a>
                </div>
            </div>
        </div>
    </div>

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
         <div class="alert alert-danger col-md-10 offset-md-1">
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
            {{-- @if (session('status'))
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
            @endif --}}
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
                         <input type="text" name="contingency" class="form-control text-center font-24"  value={{ old('contingency') ? old('contingency') : "20" }}>
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
                                  <input type="radio" class="form-check-input mr-2" name="bnk_account_type" value="Personal" @if(old('bnk_account_type') == "Personal") checked @endif />Personal
                                  </label>
                               </div>
                               <div class="form-check-inline">
                                  <label class="form-check-label">
                                  <input type="radio" class="form-check-input mr-2" name="bnk_account_type" value="Business" @if(old('bnk_account_type') == "Business") checked @endif />Business
                                  </label>
                               </div>
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <input type="text" name="bnk_account_name" class="form-control pb-3"  placeholder="Account holder’s name" value="{{ old('bnk_account_name') ?? '' }}">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-6">
                               {{-- <input type="text" class="form-control pb-3" name="bnk_sort_code"  id="sortcode" placeholder="Sort code                   __                  __"> --}}
                               {{-- <div class="row sort-code">
                                    <div class="col-3 label"><label>Sort code</label></div>
                                    <div class="col-2">
                                        <input type="text" placeholder="00" class="form-control">
                                    </div>
                                    <div class="col-1"><label class="">__</label></div>
                                    <div class="col-2">
                                        <input type="text" placeholder="00" class="form-control">
                                    </div>
                                    <div class="col-1"><label>__</label></div>
                                    <div class="col-2">
                                        <input type="text" placeholder="00" class="form-control">
                                    </div>
                               </div> --}}
                                <div class="d-flex sort-code justify-content-between">
                                    <div class="label"><label>Sort code</label></div>
                                    <input type="text" name="bnk_sort_code[]" class="form-control" maxlength="2" value="{{ old('bnk_sort_code.0') ?? '' }}" oninput="handleInput(this, 2)" placeholder="00">
                                    <label>__</label>
                                    <input type="text" name="bnk_sort_code[]" class="form-control" maxlength="2" value="{{ old('bnk_sort_code.1') ?? '' }}" oninput="handleInput(this, 2)" placeholder="00">
                                    <label>__</label>
                                    <input type="text" name="bnk_sort_code[]" class="form-control mr-15" maxlength="2" value="{{ old('bnk_sort_code.2') ?? '' }}" placeholder="00">
                                </div>

                            </div>
                            <div class="col-md-6">
                               <input type="text" class="form-control pb-3" name="bnk_account_number"  placeholder="Account number" value="{{ old('bnk_account_number') ?? '' }}">
                            </div>
                         </div>
                         <!--//-->
                         <div class="row mt-3">
                            <div class="col-md-12">
                               <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="1" id="builder_amendment" name="builder_amendment" @if(old('builder_amendment') == '1') checked @endif>
                                  <label class="form-check-label">I confirm that the account belongs myself / my company and the above details are correct</label>
                                  {{-- <label class="form-check-label">Builder registration page amendment</label> --}}
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
                                     {{-- <input type="checkbox" id="switch1" name="noti_new_quotes" value="1" {{ $notification['noti_new_quotes'] ? 'checked' : '' }}> --}}
                                     <input type="checkbox" id="switch1" name="noti_new_quotes" value="1"
                                        @php
                                            if(old('noti_new_quotes') == 1)
                                                echo "checked";
                                            else if(!empty(old()))
                                                echo "";
                                            else {
                                                echo $notification['noti_new_quotes'] ? 'checked' : '';
                                            }
                                        @endphp
                                     />
                                     <label for="switch1">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When new estimates are requested</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch2" name="noti_quote_accepted" value="1"
                                     @php
                                        if(old('noti_quote_accepted') == 1)
                                            echo "checked";
                                        else if(!empty(old()))
                                            echo "";
                                        else {
                                            echo $notification['noti_quote_accepted'] ? 'checked' : '';
                                        }
                                    @endphp
                                 />
                                     <label for="switch2">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your estimate is accepted and, where applicable, upfront payment received</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch3" name="noti_project_stopped" value="1"
                                        @php
                                            if(old('noti_project_stopped') == 1)
                                                echo "checked";
                                            else if(!empty(old()))
                                                echo "";
                                            else {
                                                echo $notification['noti_project_stopped'] ? 'checked' : '';
                                            }
                                        @endphp
                                     />
                                     <label for="switch3">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When a project is stopped</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch4" name="noti_quote_rejected" value="1"
                                     @php
                                        if(old('noti_quote_rejected') == 1)
                                            echo "checked";
                                        else if(!empty(old()))
                                            echo "";
                                        else {
                                            echo $notification['noti_quote_rejected'] ? 'checked' : '';
                                        }
                                     @endphp
                                     />
                                     <label for="switch4">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When your estimate is rejected</label>
                               </div>
                            </div>
                            <!--//-->
                            <div class="col-md-12">
                               <div class="form-check form-switch">
                                  <div class="switchToggle">
                                     <input type="checkbox" id="switch5" name="noti_project_cancelled" value="1"
                                     @php
                                     if(old('noti_project_cancelled') == 1)
                                         echo "checked";
                                     else if(!empty(old()))
                                         echo "";
                                     else {
                                         echo $notification['noti_project_cancelled'] ? 'checked' : '';
                                     }
                                     @endphp
                                     />
                                     <label for="switch5">Toggle</label>
                                 </div>
                                  <label class="form-check-label" for="mySwitch">When a project is cancelled before it starts</label>
                               </div>
                            </div>
                            {{-- <!--//-->
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                   <div class="switchToggle">
                                      <input type="checkbox" id="switch6" name="noti_share_contact_info" value="1" checked>
                                      <label for="switch6">Toggle</label>
                                  </div>
                                   <label class="form-check-label" for="mySwitch">I would like my company address and contact information to be publicly accessible so that customers can see if I am in their local area.</label>
                                </div>
                             </div>
                            <!--//--> --}}
                         </div>
                      </div>
                   </div>
                </div>
                <!--//-->
                <div class="col-md-12 justify-content-center d-flex mt-4">
                   <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="terms_and_condition" name="terms_and_condition" value="1" @if(old('terms_and_condition') == '1') checked @endif>
                      <label class="form-check-label">Please confirm you have read and agree to our <a href="{{ route('termspage', 1) }}">Terms & Conditions</a>.</label>
                   </div>
                </div>
                <div class="form-group col-md-12 mt-4 mb-4 text-center pre_">
                   {{-- <a href="{{ route('tradepersion.compregistration') }}" class="btn btn-light">Previous</a> --}}
                   <button type="submit" class="btn btn-primary disable-btn" id="form-submit-btn">Submit</button>
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

        @if (session('status'))
            $('#successRegister').modal('show');
        @endif

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

    function handleInput(inputElement, maxLength) {
        const input = inputElement.value;
        const currentLength = input.length;
        if (currentLength === maxLength) {
            const nextInput = getNextInput(inputElement);
            if (nextInput) {
                nextInput.focus();
            }
        }
    }

    function getNextInput(currentInput) {
        const allInputs = document.querySelectorAll('input[type="text"]');
        const currentIndex = Array.from(allInputs).indexOf(currentInput);
        const nextInput = allInputs[currentIndex + 1];

        return nextInput;
    }

</script>
@endpush
@endsection
