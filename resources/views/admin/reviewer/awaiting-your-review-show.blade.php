@extends('layouts.admin')
@section('title', 'Awaiting your review')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Awaiting your review </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin/project/awaiting-your-review')}}">Awaiting your review</a></li>
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
                            <label class="col-lg-3 col-form-label" for="simpleinput">Name of the project</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="simpleinput" value="{{ $project->project_name }}" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5" id="editor-description">{{ $project->description }}</textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Attachments</label>
                            <div class="col-lg-9">
                                <div class="row bg-light p-3">

                                    @if($projectmedia)
                                        @foreach ($projectmedia as $rowprojectmedia)
                                            @php
                                                $file_ext = pathinfo($rowprojectmedia->url, PATHINFO_EXTENSION);
                                            @endphp

                                            @if($file_ext=="jpg" || $file_ext=="png" || $file_ext=="JPG" || $file_ext=="PNG")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View image">
                                                            <img class="card-img-top img-fluid" src="{{@$rowprojectmedia->url}}" alt="jpg" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="xlsx" || $file_ext=="xls")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/excels.webp') }}" alt="xls" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="pdf")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View Excels" download>
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/pdf.png') }}" alt="pdf" style="width:100%;height:auto;"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            @endif

                                            @if($file_ext=="mov" || $file_ext=="mp4" || $file_ext=="3gp" || $file_ext=="ogg" || $file_ext=="webm" || $file_ext=="avi" || $file_ext=="mov" || $file_ext=="wmv")
                                                <div class="col-lg-4 col-xl-4">
                                                    <!-- Simple card -->
                                                    <div class="card mb-4 mb-xl-0">
                                                        <a href="{{@$rowprojectmedia->url}}" target="_blank" title="View video">
                                                            <img class="card-img-top img-fluid" src="{{ asset('adminpanel/file/video.jpg') }}" alt="pdf" style="width:100%;height:auto;"/>
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

                        @if ($project->reviewer_status == 'Refer')
                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                                <div class="col-lg-9">
                                    <div id="approve" style="display: none;">
                                        <a onclick="return show_approve_refer('Approve')" class="btn btn-success">Approve</a>
                                    </div>
                                    <div id="refer" style="display: block;">
                                        <a onclick="return show_approve_refer('Refer')" class="btn btn-danger">Refer</a>
                                    </div>

                                    <input type="hidden" name="your_decision" id="your_decision" value="Refer">
                                </div>
                            </div>
                        @endif

                        @if ($project->reviewer_status == 'Approve')
                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                                <div class="col-lg-9">
                                    <div id="approve" style="display: block;">
                                        <a onclick="return show_approve_refer('Approve')" class="btn btn-success">Approve</a>
                                    </div>
                                    <div id="refer" style="display: none;">
                                        <a onclick="return show_approve_refer('Refer')" class="btn btn-danger">Refer</a>
                                    </div>

                                    <input type="hidden" name="your_decision" id="your_decision" value="Approve">
                                </div>
                            </div>
                        @endif

                        @if ($project->reviewer_status == '')
                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                                <div class="col-lg-9">
                                    <div id="approve">
                                        <a onclick="return show_approve_refer('Approve')" class="btn btn-success">Approve</a>
                                    </div>
                                    <div id="refer" style="display: none;">
                                        <a onclick="return show_approve_refer('Refer')" class="btn btn-danger">Refer</a>
                                    </div>

                                    <input type="hidden" name="your_decision" id="your_decision" value="Approve">
                                </div>
                            </div>
                        @endif



                        @if($projectnotesandcommend->isNotEmpty())
                            @foreach ($projectnotesandcommend as $row)

                                @if($row->notes_for == 'customer')
                                    <div class="mb-3 row">
                                        <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="notes_for_customer" rows="5">{{ $row->notes }}</textarea>
                                        </div>
                                    </div>
                                @endif

                                @if($row->notes_for == 'internal')
                                    <div class="mb-3 row">
                                        <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="notes_for_internal" rows="5">{{ $row->notes }}</textarea>
                                        </div>
                                    </div>
                                @endif

                                @if($row->notes_for == 'tradespeople')
                                    <div class="mb-3 row">
                                        <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="notes_for_tradespeople" rows="5" id="editor-description">{{ $row->notes }}</textarea>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        @else

                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Internal</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="notes_for_internal" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Customer</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="notes_for_customer" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-3 col-form-label" for="example-textarea">Notes for Tradespeople</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="notes_for_tradespeople" rows="5"></textarea>
                                </div>
                            </div>
                        @endif

                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="addCF" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-dual"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>

                                </div>
                            </div>
                            <!-- end col -->
                        </div> --}}

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
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>


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
    CKEDITOR.replace( 'editor-description' );

   function show_approve_refer(type){
        if(type == 'Approve'){
            $("#refer").show();
            $("#approve").hide();
            $("#your_decision").attr('value','Refer');
        }
        if(type == 'Refer'){
            $("#approve").show();
            $("#refer").hide();
            $("#your_decision").attr('value','Approve');
        }

   }
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
    $("#addCF").click(function(){
        if($("#count_total_record_id").val() != ""){
            var counter = parseInt($("#count_total_record_id").val()) + 1;
            $("#count_total_record_id").attr('value',counter);
        }else{
            var counter = 2;
            $("#count_total_record_id").attr('value',counter);
        }
        var newTextBoxDiv = $(document.createElement('tr'));
        newTextBoxDiv.after().html('<td><select name="notes_for[]" id="notes_for'+counter+'" class="form-select" ><option value="internal">Internal</option><option value="customer">To Customer</option><option value="tradespeople">For Tradespeople</option></select></td><td><textarea name="description[]" class="form-control" id="description'+counter+'"></textarea></td><td><a href="javascript:void(0);" class="remCF"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg></a></td>');
        newTextBoxDiv.appendTo("#TextBoxesGroup");
        counter++;
        $(".remCF").on('click',function(){
            $(this).parent().parent().remove();
        });
    });
});

</script>
@endpush
@endsection
