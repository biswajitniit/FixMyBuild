@extends('layouts.app')

@section('content')
<!--Code area start-->

<!--Code area start-->
<section>
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center pt-5 fmb_titel">
                  <h1>Review</h1>
                  <ol class="breadcrumb mb-5">
                     <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                     <li class="breadcrumb-item"><a href="projects.html">Project list</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Submit your review</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <!--Code area end-->
      <!--Code area start-->    
      <section class="pb-5">
         <div class="container">
            <form action="#" method="post">               
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <div class="white_bg mb-5 review_wp">
                        <div class="row">
                           <div class="col-md-12 mb-40 ">
                              <h3>Punctuality</h3>
                              <div>
                                    <p>Did the tradesperson arrive on schedule?</p>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" checked name="optradio1"> Yes
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio1"> No
                                        </label>
                                    </div>
                                </div>
                            </div><!--//-->
                            <div class="col-md-12 mb-40 ">
                                <h3>Workmanship</h3>
                                <div>
                                      <p>How was the quality of their work?</p>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked name="optradio2"> Beautiful
                                          </label>
                                      </div>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked name="optradio2"> It's ok
                                          </label>
                                      </div>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="optradio2"> Awful
                                          </label>
                                      </div>
                                  </div>
                            </div><!--//-->
                            <div class="col-md-12 mb-40 ">
                                <h3>Tidiness</h3>
                                <div>
                                      <p>Did they leave your place tidy after the work was completed?</p>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked name="optradio3"> Yes
                                          </label>
                                      </div>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="optradio3"> No
                                          </label>
                                      </div>
                                  </div>
                            </div><!--//-->
                            <div class="col-md-12 mb-40 ">
                                <h3>Price accuracy</h3>
                                <div>
                                      <p>Was their estimated price accurate?</p>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked name="optradio4"> Yes
                                          </label>
                                      </div>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="optradio4"> No
                                          </label>
                                      </div>
                                  </div>
                            </div><!--//-->
                            <div class="col-md-12 mb-40 ">
                                <h3>Detailed review</h3>
                                <div>
                                      <p>Would you like to leave a descriptive review?</p>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                            <input type="radio" class="form-check-input" checked name="optradio5"> Yes
                                          </label>
                                      </div>
                                      <div class="form-check-inline">
                                          <label class="form-check-label">
                                          <input type="radio" class="form-check-input" name="optradio5"> No
                                          </label>
                                      </div>
                                  </div>
                            </div><!--//-->
                            <div class="col-md-12 mb-4">
                                {{-- <div id="summernote"></div> --}}
                                <textarea name="description" id="summernote"></textarea>

                            </div>
                        </div>
                     </div>
                     <div class="form-group col-md-12 mt-5 text-center pre_">
                        <a href="projects.html" class="btn btn-light mr-3">Back</a> 
                        <a href="#" class="btn btn-primary">Submit </a>
                     </div>
                  </div>
               </div>
               
               <!--// END-->
            </form>
      @endsection