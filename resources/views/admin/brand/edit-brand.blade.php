<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Brand</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/css-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- End plugin css for this page -->


      <!-- Plugin css for this page -->
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/dropzone/dropzone.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-1to10.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-horizontal.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-movie.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-pill.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-reversed.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bars-square.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/bootstrap-stars.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/css-stars.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/examples.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/fontawesome-stars-o.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/fontawesome-stars.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-asColorPicker/css/asColorPicker.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/x-editable/bootstrap-editable.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/dropify/dropify.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-file-upload/uploadfile.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
      <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
      <!-- End plugin css for this page -->





    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/css/demo_1/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminpanel/assets/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">




</head>
<body>

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



              <form class="cmxform" id="editbrand" method="post" action="{{ route('admin.edit-brand-post') }}" name="editbrand" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="brandid" value="{{ $brand->id }}">
                <input type="hidden" name="brand_image_old_file_name" value="{{ $brand->brand_image_name }}">
                <input type="hidden" name="brand_image_old_path" value="{{ $brand->brand_image_path }}">
                <fieldset>
                    <div class="form-group">
                        <label for="category_id">Category Name</label>
                        <select name="category_id" class="js-example-basic-single" style="width: 100%;">
                            <option value="">Select Category</option>
                            @if($category) @foreach ($category as $rowcategory)
                            <option value="{{ $rowcategory->id }}" @if($rowcategory->id == $brand->category_id) selected="selected" @endif>{{ $rowcategory->category_name }}</option>
                            @endforeach @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_category_id">Sub Category</label>
                        <select name="sub_category_id" class="subcategory" style="width: 100%;">
                            <option value="">Select Sub Category</option>
                            @php $getcatid = GetSubcategoryBycatid($brand->category_id); @endphp @foreach($getcatid as $rowsubcat)
                            <option value="{{ $rowsubcat->id }}" @if($rowsubcat->id == $brand->sub_category_id) selected="selected" @endif>{{ $rowsubcat->sub_category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sub_category_item_id">Sub Category Item</label>
                        <select name="sub_category_item_id" class="subcategory" style="width: 100%;">
                            <option value="">Select Sub Category</option>
                            @php $getsubcatitemid = GetSubcategoryitemBysubcatid($brand->sub_category_id); @endphp @foreach($getsubcatitemid as $rowsubcatitem)
                            <option value="{{ $rowsubcatitem->id }}" @if($rowsubcatitem->id == $brand->sub_category_item_id) selected="selected" @endif>{{ $rowsubcatitem->sub_category_item_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brand_name">Brand Name <span class="required">*</span></label>
                        <input id="brand_name" class="form-control" name="brand_name" type="text" value="{{ $brand->brand_name }}" />
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="brand_image" class="col-form-label">Image </label>
                            <input type="file" name="brand_image" class="dropify" />
                        </div>
                        <div class="col-sm-6">
                            <img src="{{ $brand->brand_image_path }}" name="brandimage" style="width: 200px; height:auto;"/>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="status" id="status1" value="1" @if($brand->status == 1) checked @endif> Active </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label"> <input type="radio" class="form-check-input" name="status" id="status2" value="2" @if($brand->status == 2) checked @endif> InActive </label>
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




  <!-- plugins:js -->
  <script src="{{ url('adminpanel/assets/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <script src="{{ url('adminpanel/assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>



  <!-- Plugin js for this page -->
  <script src="{{ url('adminpanel/assets/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/flot/jquery.flot.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/flot/jquery.flot.resize.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/flot/jquery.flot.categories.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/flot/jquery.flot.stack.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ url('adminpanel/assets/js/off-canvas.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/hoverable-collapse.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/misc.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/settings.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ url('adminpanel/assets/js/dashboard.js')}}"></script>
  <!-- End custom js for this page -->
  <script src="{{ url('adminpanel/assets/js/data-table.js')}}"></script>

  <!-- Plugin js for this page -->
  <script src="{{ url('adminpanel/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <!-- End plugin js for this page -->

  <!-- Custom js for this page -->

  <script src="{{ url('adminpanel/assets/js/bt-maxLength.js')}}"></script>

  <script src="{{ url('adminpanel/assets/vendors/select2/select2.min.js')}}"></script>
  <script src="{{ url('adminpanel/assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>

  <script src="{{ url('adminpanel/assets/js/typeahead.js')}}"></script>
  <script src="{{ url('adminpanel/assets/js/select2.js')}}"></script>

    <!-- Plugin js for this page -->
    <script src="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery-asColor/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery-asColorPicker/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/x-editable/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery-file-upload/jquery.uploadfile.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/jquery.repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/inputmask/jquery.inputmask.bundle.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    <script src="{{ asset('adminpanel/assets/js/formpickers.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/form-addons.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/x-editable.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/dropify.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/jquery-file-upload.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/formpickers.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/form-repeater.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/inputmask.js') }}"></script>
    <!-- End custom js for this page -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(".alert").delay(2000).slideUp(200, function () {
            $(this).alert('close');
        });

        $(function() {
            // validate signup form on keyup and submit
            $("#editbrand").validate({
                rules: {
                    category_id: "required",
                    sub_category_id: "required",
                    sub_category_item_id : "required",
                    brand_name : "required",
                },
                messages: {
                    category_id: "Please select category",
                    sub_category_id: "Please select sub category",
                    sub_category_item_id: "Please select sub category item",
                    brand_name: "Please enter brand name",
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
</body>

</html>
