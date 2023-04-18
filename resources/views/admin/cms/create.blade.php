@extends('layouts.admin')
@section('title', 'Add Cms')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add Cms </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('cms.index') }}">Cms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Cms</li>
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



              <form class="cmxform" id="addbanner" method="post" action="{{ route('cms.store') }}" name="addbanner" enctype="multipart/form-data">
                @csrf
                <fieldset>

                  <div class="form-group">
                    <label for="cms_pagename">Page Name <span class="required">*</span></label>
                    <input id="cms_pagename" class="form-control" name="cms_pagename" type="text" required>
                  </div>

                  <div class="form-group">
                    <label for="cms_heading">Heading <span class="required">*</span></label>
                    <input id="cms_heading" class="form-control" name="cms_heading" type="text">
                  </div>

                  <div class="form-group">
                    <label for="cms_description">Cms Text <span class="required">*</span></label>
                    <textarea id="cms-editor" class="form-control" name="cms_description" required></textarea>
                    {{-- <textarea id="summernote" name="editordata"></textarea> --}}
                  </div>

                  <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select name="status" class="js-example-basic-single" style="width:100%" >
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                  </div>

                  <input class="btn btn-primary" type="submit" value="Submit">
                </fieldset>
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
    <script type="text/javascript">
        CKEDITOR.replace( 'cms-editor' );
        // $(document).ready(function() {
        //     $('#summernote').summernote();
        // });

    </script>
@endpush
@endsection
