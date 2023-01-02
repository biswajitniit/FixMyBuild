@extends('layouts.admin')
@section('title', 'Edit Attribute')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Edit Attribute</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('attribute') }}">Attributes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Attributes</li>
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



              <form class="cmxform" id="editattribute" method="post" action="{{ route('admin.edit-attribute-post') }}" name="editattribute">
                @csrf
                <input type="hidden" name="attributeid" value="{{ $attribute->id }}">
                <fieldset>


                    <div class="form-group">
                        <label for="column_name">Column Name </label>
                        <input id="column_name" class="form-control" name="column_name" type="text" value="{{ $attribute->column_name }}">
                    </div>

                  <div class="form-group">
                    <label for="column_type">Column Type</label>
                    <select name="column_type" class="js-example-basic-single" style="width:100%">
                        <option value="">Select Column Type</option>
                        <option value="1" @if($attribute->id == 1) selected="selected" @endif>TextBox</option>
                        <option value="2" @if($attribute->id == 2) selected="selected" @endif>Drop Down</option>
                        <option value="3" @if($attribute->id == 3) selected="selected" @endif>Editor</option>
                        <option value="4" @if($attribute->id == 4) selected="selected" @endif>Password</option>
                        <option value="5" @if($attribute->id == 5) selected="selected" @endif>Email</option>
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="column_validation">Column Validation</label>
                    <select name="column_validation" class="js-example-basic-single" style="width:100%;">
                        <option value="">Select Column Validation</option>
                        <option value="1" @if($attribute->column_validation == 1) selected="selected" @endif>Optional</option>
                        <option value="2" @if($attribute->column_validation == 2) selected="selected" @endif>Required</option>
                    </select>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-4">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" id="status1" value="1" @if($attribute->status == 1) checked @endif> Active </label>
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="status" id="status2" value="2" @if($attribute->status == 2) checked @endif> InActive </label>
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
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">Hemchhaya</a>. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
  </div>
  <!-- main-panel ends -->





@push('scripts')
    <script type="text/javascript">
        $(".alert").delay(2000).slideUp(200, function () {
            $(this).alert('close');
        });

        $(function() {
            // validate signup form on keyup and submit
            $("#addsubcategoryitem").validate({
                rules: {
                    category_id: "required",
                    sub_category_id: "required",
                    sub_category_item_name : "required",
                },
                messages: {
                    category_id: "Please select category",
                    sub_category_id: "Please select sub category",
                    sub_category_item_name: "Please enter sub category item name",
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

        (function($) {
            if ($(".subcategory").length) {
                $(".subcategory").select2();
            }
        })(jQuery);

        $("document").ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var catId = $(this).val();
                if (catId) {
                    $.ajax({
                        url: "{{route('admin.getsubcategory')}}",
                        type: "POST",
                        data:{categoryid:catId, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (returndata) {
                            $('select[name="sub_category_id"]').empty();
                            $.each(returndata, function (key, value) {
                                $('select[name="sub_category_id"]').append('<option value=" ' + value.id + '">' + value.text + '</option>');
                            })
                        }
                    })
                } else {
                    $('select[name="sub_category_id"]').empty();
                }
            });
        });
    </script>
@endpush
@endsection
