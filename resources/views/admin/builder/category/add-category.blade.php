@extends('layouts.admin')
@section('title', 'Add Category')
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
                <fieldset>


                  <div class="form-group">
                    <label for="builder_category_name">Category Name <span class="required">*</span></label>
                    <input id="builder_category_name" class="form-control" name="builder_category_name" type="text">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" id="status1" value="Active" checked> Active </label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" id="status2" value="InActive"> InActive </label>
                      </div>
                    </div>
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
        $(".alert").delay(2000).slideUp(200, function () {
            $(this).alert('close');
        });

        $(function() {
            // validate signup form on keyup and submit
            $("#addcategory").validate({
            rules: {
                category_name: "required",
            },
            messages: {
                category_name: "Please enter category name",
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function(element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            }
            });
        });

    </script>
@endpush
@endsection
