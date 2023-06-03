@extends('layouts.app')


@section('content')
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
            <form id="reviewForm" name="reviewForm" action="{{ route('customer.review') }}" method="post">
                @csrf
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
                                                <input type="radio" class="form-check-input" name="optradio1" value="1" onclick="hide('errorMsg1');"> Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio1" onclick="hide('errorMsg1');" value="0"> No
                                            </label>
                                        </div>
                                        <p id="errorMsg1" style="display: none;color: red">This Fill Is Required</p>
                                    </div>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Workmanship</h3>
                                    <div>
                                        <p>How was the quality of their work?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="2"> Beautiful
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="1"> It's OK</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio2" onclick="hide('errorMsg2');" value="0"> Awful</label>
                                        </div>
                                    </div>
                                    <p id="errorMsg2" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Tidiness</h3>
                                    <div>
                                        <p>Did they leave your place tidy after the work was completed?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio3" onclick="hide('errorMsg3');" value="1"> Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio3" onclick="hide('errorMsg3');" value="0"> No
                                            </label>
                                        </div>
                                    </div>
                                    <p id="errorMsg3" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Price accuracy</h3>
                                    <div>
                                        <p>Was their estimated price accurate?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio4" onclick="hide('errorMsg4');" value="1"> Yes
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optradio4" onclick="hide('errorMsg4');" value="0"> No
                                            </label>
                                        </div>
                                    </div>
                                    <p id="errorMsg4" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12 mb-40 ">
                                    <h3>Detailed review</h3>
                                    <div>
                                        <p>Would you like to leave a descriptive review?</p>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="ifYes" name="optradio5" onchange="clickYes()", onclick="hide('errorMsg5');" value="1"> Yes</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" id="ifNo" name="optradio5" onchange="clickNo()", onclick="hide('errorMsg5');" value="0"> No</label>
                                        </div>
                                    </div>
                                    <p id="errorMsg5" style="display: none;color: red">This Fill Is Required</p>
                                </div>
                                <!--//-->
                                <div class="col-md-12">
                                    <textarea name="detailed_review" id="detailed_review" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $project_id }}">

                        <div class="form-group col-md-12 mt-5 text-center pre_">
                            <a href="projects.html" class="btn btn-light mr-3">Back</a>
                            <button type="button" class="btn btn-primary" onclick="validate()">Submit </button>
                        </div>
                    </div>
                </div>
                <!--// END-->
            </form>
        </div>
    </section>
    <!--Code area end-->
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{ asset('frontend/validatejs/jquery.validate.js') }}"></script>

    <script>
        function validate() {
            var validateflag = 0
            var detailed_review = $('#detailed_review').val();
            var error1 = document.getElementById("errorMsg1")
            var error2 = document.getElementById("errorMsg2")
            var error3 = document.getElementById("errorMsg3")
            var error4 = document.getElementById("errorMsg4")
            var error5 = document.getElementById("errorMsg5")
            const optradio1 = $('input[name="optradio1"]:checked').val();
            if (optradio1 == null) {
                error1.style.display = 'block';
                validateflag = 1
            }
            const optradio2 = $('input[name="optradio2"]:checked').val();
            if (optradio2 == null) {
                error2.style.display = 'block';
                validateflag = 1
            }
            const optradio3 = $('input[name="optradio3"]:checked').val();
            if (optradio3 == null) {
                error3.style.display = 'block';
                validateflag = 1
            }
            const optradio4 = $('input[name="optradio4"]:checked').val();
            if (optradio4 == null) {
                error4.style.display = 'block';
                validateflag = 1
            }
            const optradio5 = $('input[name="optradio5"]:checked').val();
            if (optradio5 == null) {
                error5.style.display = 'block';
                validateflag = 1
            } else {
                const ifYes = $('#ifYes').is(':checked')
                const ifNo = $('#ifNo').is(':checked')
                if(ifYes==true){
                    if(detailed_review==''){
                        alert('Details review is blank');
                        validateflag = 1;
                    }
                }
                else if(ifNo==true){

                }
            }
            if (validateflag !=1) {
                const project_id = $('#project_id').val();
                $.ajax({
                    url: "{{ route('customer.review') }}",
                    type: "POST",
                    data: {
                        'optradio1': optradio1,
                        'optradio2': optradio2,
                        'optradio3': optradio3,
                        'optradio4': optradio4,
                        'optradio5': optradio5,
                        'detailed_review': detailed_review,
                        'project_id': project_id,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response == 'Done') {
                            alert('Review Saved Successfully');
                        } else {
                            alert(response);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        function clickYes() {
            const forYes = document.getElementById("ifYes");
            const textBox = document.getElementById("detailed_review");
            if (forYes.clicked == false) {
                textBox.disabled = true;
            } else {
                textBox.disabled = false;
            }

        }

        function clickNo() {
            const forNo = document.getElementById("ifNo");
            const textBox = document.getElementById("detailed_review");

            if (forNo.clicked == false) {
                textBox.disabled = false;
            } else {
                textBox.disabled = true;
                textBox.value = ''
            }
        }

        function hide(string){
            var element=document.getElementById(string);
            element.style.display='none';
        }

    </script>
@endpush
