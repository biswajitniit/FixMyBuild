@extends('layouts.admin')
@section('title', 'Add Brand')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Add Brand</h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.brand') }}">Brands</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">

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



              <form class="cmxform" id="addbrand" method="post" action="{{ route('admin.add-brand-post-data') }}" name="addbrand" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="form-group">
                        <label for="category_id">Category Name <span class="required">*</span></label>
                        <select name="category_id" class="js-example-basic-single" style="width: 100%;">
                            <option value="">Select Category</option>
                            @if($category) @foreach ($category as $rowcategory)
                            <option value="{{ $rowcategory->id }}">{{ $rowcategory->category_name }}</option>
                            @endforeach @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_category_id">Sub Category <span class="required">*</span></label>
                        <select name="sub_category_id" class="subcategory" style="width: 100%;">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_category_item_id">Sub Category Item <span class="required">*</span></label>
                        <select name="sub_category_item_id" class="subcategory" style="width: 100%;">
                            <option value="">Select Sub Category Item</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_name">Brand Name <span class="required">*</span></label>
                        <input id="brand_name" class="form-control" name="brand_name" type="text" />
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="brand_image" class="col-form-label">Image </label>
                            <input type="file" name="brand_image" class="dropify" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status <span class="required">*</span></label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="status" id="status1" value="1" checked /> Active </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="status" id="status2" value="2" /> InActive </label>
                            </div>
                        </div>
                    </div>

                    <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
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
                    sub_category_item_id : "required",
                    attribute_category_name : "required",
                },
                messages: {
                    category_id: "Please select category",
                    sub_category_id: "Please select sub category",
                    sub_category_item_id: "Please select sub category item",
                    attribute_category_name: "Please enter attribute category name",
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
                        url: "{{route('admin.getsubcategoryonattributepage')}}",
                        type: "POST",
                        data:{categoryid:catId, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (returndata) {
                            $('select[name="sub_category_id"]').empty();
                            $.each(returndata, function (key, value) {
                                $('select[name="sub_category_id"]').append('<option value=\'' +value.id+'\'>' + value.text + '</option>');
                            })
                        }
                    })
                } else {
                    $('select[name="sub_category_id"]').empty();
                }
            });

            $('select[name="sub_category_id"]').on('change', function () {
                var subcatId = $(this).val();
                if (subcatId) {
                    $.ajax({
                        url: "{{route('admin.getsubcategoryitemonattributepage')}}",
                        type: "POST",
                        data:{subcategoryid:subcatId, _token: '{{csrf_token()}}'},
                        dataType: "json",
                        success: function (returndata) {
                            $('select[name="sub_category_item_id"]').empty();
                            $.each(returndata, function (key, value) {
                                $('select[name="sub_category_item_id"]').append('<option value=\'' +value.id+'\'>' + value.text + '</option>');
                            })
                        }
                    })
                } else {
                    $('select[name="sub_category_item_id"]').empty();
                }
            });


        });
    </script>
@endpush
@endsection
