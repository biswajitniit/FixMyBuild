@extends('layouts.admin')
@section('title', 'Projects')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Projects </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin/project/awaiting-your-review')}}">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Review</li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              {{-- <h4 class="card-title">Complete form validation</h4> --}}

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



              <form class="cmxform" id="save_awaiting_review" method="post" action="{{ route('awaiting-your-review-save') }}" name="save_awaiting_review">
                @csrf
                <input type="hidden" name="projectid" value="{{$project->id}}">

                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Forename</label>
                            <div class="col-lg-9 mt-2">
                                {{ $project->forename }}
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Surname</label>
                            <div class="col-lg-9 mt-2">
                                {{ $project->surname }}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Name of the project</label>
                            <div class="col-lg-9 mt-2">
                                {{ ucwords($project->project_name) }}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Description</label>
                            <div class="col-lg-9 mt-2">
                                {{htmlspecialchars(trim(strip_tags($project->description )))}}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Attachments</label>
                            <div class="col-lg-9 mt-2">
                                <div class="row bg-light p-3">

                                    @if($projectmedia)
                                        @foreach ($projectmedia as $rowprojectmedia)
                                            @php
                                                $file_ext = pathinfo($rowprojectmedia->url, PATHINFO_EXTENSION);
                                            @endphp

                                            @if($file_ext=="jpg" || $file_ext=="png" || $file_ext=="JPG" || $file_ext=="PNG")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View image">
                                                            <img class="card-img-top img-fluid" src="{{@$rowprojectmedia->url}}" alt="jpg" style="width:50%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="xlsx" || $file_ext=="xls")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/excels.webp') }}" alt="xls" style="width:25%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="pdf")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/pdf.png') }}" alt="pdf" style="width:25%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="mov" || $file_ext=="mp4" || $file_ext=="3gp" || $file_ext=="ogg" || $file_ext=="webm" || $file_ext=="avi" || $file_ext=="mov" || $file_ext=="wmv" || $file_ext=="mkv")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View video">
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/video.jpg') }}" alt="video" style="width:30%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                                <div class="col-lg-9  mt-2">
                                    <select name="reviewer_status" id="reviewer_status" class="reviewer-status form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="approved" {{ $project->reviewer_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="referred" {{ $project->reviewer_status == 'referred' ? 'selected' : '' }}>Referred</option>
                                    </select>
                                </div>
                            </div>
                          <div class="mb-3 row">
                              <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Internal</label>
                              <div class="col-lg-9 mt-3">
                                  <textarea class="form-control" name="notes_for_internal" id="notes_for_internal" rows="10">{{ old('notes_for_internal') ??$project->internal_note }}</textarea>
                              </div>
                          </div>
                          <div class="mb-3 row">
                              <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Customer</label>
                              <div class="col-lg-9 mt-3">
                                  <textarea class="form-control" name="notes_for_customer" id="notes_for_customer" rows="10">{{ old('notes_for_customer') ??$project->customer_note }}</textarea>
                              </div>
                          </div>
                          <div class="mb-3 row">
                              <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Tradespeople</label>
                              <div class="col-lg-9 mt-3">
                                  <textarea class="form-control" name="notes_for_tradespeople" id="notes_for_tradespeople" rows="10">{{ old('notes_for_tradespeople') ?? $project->tradeperson_note }}</textarea>
                              </div>
                          </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Categories</label>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card" style="height:250px; overflow-y: scroll;">
                                    <div class="card-body">
                                        @php
                                            $category = explode(",",$project->categories);
                                            //echo "<pre>"; print_r($category); die;
                                           // echo count($category); die
                                        @endphp
                                        @if($buildercategory)
                                            @foreach ($buildercategory as $key => $value)
                                            <div class="mt-1">
                                                <div class="form-check mb-1">
                                                    <input type="checkbox" name="builder_category[]" class="form-check-input catid" id="customCheck{{$value->id}}" value="{{$value->id}}" @if(in_array($value->id, $category)) checked @endif  onclick="get_builder_subcategory_list(this.value)"/>
                                                    <label class="form-check-label" for="customCheck{{$value->id}}" >{{ $value->builder_category_name }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="height:250px; overflow-y: scroll;">
                                    <div class="card-body" id="buildersubcategory">


                                        @if(!empty(array_filter($category)))
                                            @foreach ($category as $rowcategory)
                                                @php
                                                    $buildersubcategory = GetBuildersubcategory($rowcategory);
                                                    $projectsubcategory = explode(",",$project->subcategories);
                                                @endphp

                                                <h4 class="header-title mt-3">{{ GetBuildercategoryname($rowcategory) }}</h4>

                                                @if($buildersubcategory)
                                                    @foreach ($buildersubcategory as $skey => $svalue)

                                                    <div class="mt-1">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="builder_subcategory[]" class="form-check-input" id="subcat{{$svalue->id}}" value="{{$svalue->id}}" @if(in_array($svalue->id, $projectsubcategory)) checked @endif/>
                                                            <label class="form-check-label" for="customCheck{{$svalue->id}}">{{$svalue->builder_subcategory_name}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif

                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                    </div>
                    <div class="row mt-15">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" onclick="confirmYourReviews()" data-bs-toggle="modal" data-bs-target="#comfirm_review">Submit</button>
                        </div>
                    </div>

                     {{-- modal --}}
                    <div class="modal fade" id="comfirm_review" tabindex="-1" aria-labelledby="comfirm_reviewLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="comfirm_reviewLabel">Confirm Your Decision</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea"><b>Notes for Internal : </b></label>
                                    <div class="col-lg-9 mt-3">
                                        <p id="for_internal" name="for_internal"></p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea"><b>Notes for Customer : </b></label>
                                    <div class="col-lg-9 mt-3">
                                        <p id="for_customer" name="for_customer"></p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea"><b>Notes for Tradespeople : </b></label>
                                    <div class="col-lg-9 mt-3">
                                        <p id="for_tradeperson" name="for_tradeperson"></p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea"><b>Your Decision :</b></label>
                                    <div class="col-lg-9 mt-3">
                                        <p id="for_your_decision" name="for_your_decision"></p>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-9">
                                        <p><strong>Please check your wording here before pressing the "Confirm Submit" button. Communications cannot be recalled after they are sent.</strong></p>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary" id="final_submit">Confirm Submit</button>
                                    </div>
                                    <div class="col-1 ps-0">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>

                    {{-- modal end --}}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
  </div>
  <!-- main-panel ends -->
@push('scripts')
<script>

function get_builder_subcategory_list() {
    var val = [];
    $('.catid:checked').each(function(i) {
        val[i] = $(this).val();
    });

    if(val!=''){
        $.ajax({
            type:'POST',
            url:'{{ route("get-builder-subcategory-list") }}',
            data:{catid:val,_token: '{{csrf_token()}}'},
            success:function(result){
                $("#buildersubcategory").html(result);
            }
        });
    }
}

$(document).ready(function(){
    $('#final_submit').on('click', function(){
        $('#save_awaiting_review').trigger('submit');
    });
});

function confirmYourReviews(){
    var forTradeperson = $('#notes_for_tradespeople').val();
    var forCustomer = $('#notes_for_customer').val();
    var forInternal = $('#notes_for_internal').val();
    var forYourDesicion = $('#reviewer_status').val();

    $('#for_tradeperson').text(forTradeperson);
    $('#for_customer').text(forCustomer);
    $('#for_internal').text(forInternal);
    $('#for_your_decision').text(forYourDesicion);
}

</script>
@endpush
@endsection
