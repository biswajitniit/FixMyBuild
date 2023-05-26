@extends('layouts.admin')
@section('title', 'Edit Terms Category')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Edit Terms Category </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('terms.index') }}">Terms Category List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Terms Category</li>
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

              <form class="cmxform" id="updateterms" method="post" action="{{ route('terms.update', $termsdata->id) }}" name="updateterms" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset>

                  <div class="form-group">
                    <label for="name">Name <span class="required">*</span></label>
                    <input id="name" class="form-control" name="name" type="text" value="{{ $termsdata->name }}">
                  </div>

                  <div class="form-group">
                    <label for="terms_order">Terms Order </label>
                    <input id="terms_order" class="form-control" name="terms_order" type="text" value="{{ $termsdata->terms_order }}" required>
                  </div>

                  <div class="form-group">
                    <label for="terms_description">Terms Description <span class="required">*</span></label>
                    <textarea id="terms-editor" class="form-control" name="terms_description" required>{!! $termsdata->terms_description !!}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="status">Status <span class="required">*</span></label>
                    <select name="status" class="js-example-basic-single" style="width:100%" >
                        <option value="Active" @if($termsdata->status == 'Active') selected @endif>Active</option>
                        <option value="Inactive" @if($termsdata->status == 'Inactive') selected @endif>Inactive</option>
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
        CKEDITOR.replace( 'terms-editor' );
    </script>
@endpush
@endsection
