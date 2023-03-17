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

@endpush
@endsection
