<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.bootstrapdash.com/demo/plus/jquery/template/demo_1/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Aug 2022 10:53:43 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
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
    <div class="container-scroller">
      {{-- <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
            <div class="ps-lg-3">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/plus-admin-template/?utm_source=navbar&amp;utm_medium=productdemo&amp;utm_campaign=getpro" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/plus-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white"></i>
              </button>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          {{-- <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="{{ asset('adminpanel/assets/images/faces/face1.jpg') }}" alt="profile">

              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center">Antonio Olson</span>
                <span class="text-secondary icon-sm text-center">$3499.00</span>
              </div>
            </a>
          </li> --}}
          <li class="nav-item pt-3">
            <a class="nav-link d-block" href="{{url('/admin/dashboard')}}">
              <img class="sidebar-brand-logo" src="{{ asset('adminpanel/assets/images/logo.png') }}"  alt="" width="100%" height="50px;">
              {{-- <img class="sidebar-brand-logo" src="https://www.bootstrapdash.com/demo/plus/jquery/template/assets/images/logo.svg" alt="">
              <img class="sidebar-brand-logomini" src="https://www.bootstrapdash.com/demo/plus/jquery/template/assets/images/logo-mini.svg" alt=""> --}}
              {{-- <div class="small font-weight-light pt-1">Responsive Dashboard </div> --}}
            </a>
            {{-- <form class="d-flex align-items-center" action="#">
              <div class="input-group">
                <div class="input-group-prepend">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control border-0" placeholder="Search">
              </div>
            </form> --}}
          </li>
          {{-- <li class="pt-2 pb-1">
            <span class="nav-item-head">Template Pages</span>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/admin/dashboard') }}">
              <i class="mdi mdi-view-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if (Auth::guard('admin')->user()->type == "superadmin")
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#category" aria-expanded="false" aria-controls="apps">
                        <i class="mdi mdi-menu menu-icon"></i>
                        <span class="menu-title">Builders</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('buildercategory.index') }}">Category</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('buildersubcategory.index') }}">Sub Category</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/users') }}">
                        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                        <span class="menu-title">Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cms.index') }}">
                      <i class="mdi mdi-file-document-box menu-icon"></i>
                      <span class="menu-title">CMS Pages</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('terms.index') }}">
                      <i class="mdi mdi-file-document-box menu-icon"></i>
                      <span class="menu-title">Terms Page</span>
                    </a>
                </li>
          @endif

          @if (Auth::guard('admin')->user()->type == "reviewer")
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/project/awaiting-your-review') }}">
                  <i class="mdi mdi-view-dashboard menu-icon"></i>
                  <span class="menu-title">Awaiting your review</span>
                </a>
            </li>

          @endif


          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#Setting" aria-expanded="false" aria-controls="apps">
              <i class="mdi mdi-settings menu-icon"></i>
              <span class="menu-title">Setting</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Setting">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('/admin/changepassword') }}">Change Password</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('/admin/logout') }}">Logout</a></li>
              </ul>
            </div>
          </li>

        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-default-theme">
            <div class="img-ss rounded-circle bg-light border me-3"></div>Default
          </div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles default primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles light"></div>
          </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            {{-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-chevron-double-left"></span>
            </button> --}}
            {{-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
              <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="https://www.bootstrapdash.com/demo/plus/jquery/template/assets/images/logo-mini.svg" alt="logo" /></a>
            </div> --}}
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face1.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                      <p class="text-gray mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face6.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                      <p class="text-gray mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="../assets/images/faces/face7.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                      <p class="text-gray mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
                </div>
              </li>
              <li class="nav-item dropdown ms-3">
                <a class="nav-link" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-success">
                        <i class="mdi mdi-calendar"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">New order recieved</h6>
                      <p class="text-gray ellipsis mb-0"> 45 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-warning">
                        <i class="mdi mdi-settings"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Server limit reached</h6>
                      <p class="text-gray ellipsis mb-0"> 55 sec ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-info">
                        <i class="mdi mdi-link-variant"></i>
                      </div>
                    </div>
                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                      <h6 class="preview-subject font-weight-normal mb-0">Kevin karvelle</h6>
                      <p class="text-gray ellipsis mb-0"> 11:09 PM </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                </div>
              </li>
            </ul>
           <ul class="navbar-nav navbar-nav-right">
            {{--   <li class="nav-item nav-logout d-none d-md-block me-3">
                <a class="nav-link" href="#">Status</a>
              </li>
              <li class="nav-item nav-logout d-none d-md-block">
                <button class="btn btn-sm btn-danger">Trailing</button>
              </li>
               <li class="nav-item nav-profile dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="nav-profile-text">English </div>
                </a>
                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-bl me-3"></i> French </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-cn me-3"></i> Chinese </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-de me-3"></i> German </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">
                    <i class="flag-icon flag-icon-ru me-3"></i>Russian </a>
                </div>
              </li> --}}
              <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="{{ url('/admin/logout') }}">
                  <i class="mdi mdi-logout-variant"></i>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->





        @yield('content')






      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('adminpanel/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <script src="{{ asset('adminpanel/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>



    <!-- Plugin js for this page -->
    <script src="{{ asset('adminpanel/assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/flot/jquery.flot.fillbetween.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('adminpanel/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/misc.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/settings.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('adminpanel/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <script src="{{ asset('adminpanel/assets/js/data-table.js') }}"></script>

    <!-- Plugin js for this page -->
    <script src="{{ asset('adminpanel/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('adminpanel/assets/js/form-validation.js') }}"></script> --}}
    <script src="{{ asset('adminpanel/assets/js/bt-maxLength.js') }}"></script>

    <script src="{{ asset('adminpanel/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>

    <script src="{{ asset('adminpanel/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('adminpanel/assets/js/select2.js') }}"></script>


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

    <script src="{{ asset('adminpanel/ckeditor/ckeditor.js') }}"></script>

    @stack('scripts')

  </body>

</html>
