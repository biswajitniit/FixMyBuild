@extends('layouts.admin')
@section('title', 'Awaiting your review')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add Category </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('buildercategory.index')}}">Categorys</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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



              <form class="cmxform" id="addcategory" method="post" action="{{ route('buildercategory.store') }}" name="addcategory">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Name of the project</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" id="simpleinput" value="" />
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5" id="example-textarea"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="simpleinput">Attachments</label>
                            <div class="col-lg-9">
                                <div class="row bg-light p-3">
                                    <div class="col-lg-4 col-xl-4">
                                        <!-- Simple card -->
                                        <div class="card mb-4 mb-xl-0">
                                            <img class="card-img-top img-fluid" src="assets/images/small/img-1.jpg" alt="Card image cap" />
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap" />
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4 col-xl-4">
                                        <div class="card mb-4 mb-xl-0">
                                            <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap" />
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Description</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5" id="example-textarea"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="example-textarea">Your Decision</label>
                            <div class="col-lg-9">
                                <button type="button" class="btn btn-outline-primary">Approve</button> <button type="button" class="btn btn-outline-danger">Refer</button>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Notes and Comments</label>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>

                        <div class="row">

                            <div class="col-md-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus icon-dual"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>

                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <select name="">
                                            <option value="">Internal</option>
                                            <option value="">To Customer</option>
                                            <option value="">For Tradespeople</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <textarea name=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
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

                                        @if($buildercategory)
                                            @foreach ($buildercategory as $rowcategory)
                                            <div class="mt-1">
                                                <div class="form-check mb-1">
                                                    <input type="checkbox" class="form-check-input catid" id="customCheck{{$rowcategory->id}}" value="{{$rowcategory->id}}"  onclick="get_builder_subcategory_list(this.value)"/>
                                                    <label class="form-check-label" for="customCheck{{$rowcategory->id}}">{{ $rowcategory->builder_category_name }}</label>
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

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
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
</script>
@endpush
@endsection
