@extends('layouts.admin')
@section('title', 'Category Listing')
@section('content')



<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header flex-wrap">
        <div class="header-left">
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">

          <button type="button" onclick="location.href='{{ route('buildercategory.create')}}'" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
            <i class="mdi mdi-plus-circle"></i> Add Category </button>
        </div>
      </div>
      {{-- @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
     @endif --}}

      @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}
      </div>
      @endif

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Category table</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                {{-- <table id="order_listing" class="table order_listing"> --}}
                <table class="table table-bordered table-striped mb-none" id="my-table">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th>Category Name</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>

                </table>
              </div>
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


        $(document).ready(function(){
        // DataTable
            $('#my-table').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [[100, 200, 300], [100, 200, 300]],
                order: [[ 0, "asc" ]],
                columnDefs: [{
                    "searchable": true,
                    "orderable": false,
                    "targets": 0
                }],
                "ajax": {
                    data: ({_token: '{{csrf_token()}}'}),
                    url : "{{route('getbuildercategory')}}",
                    type : 'GET',
                },
                columns: [
                        {data: 'builder_category_name' },
                        {
                            data: 'status',
                            render: function (data, type, row){
                                if(data == "Active"){
                                    return '<label class="badge badge-success">Active</label>';
                                }else{
                                    return '<label class="badge badge-danger">In Active</label>';
                                }
                            },
                        },
                       { data: 'action' },
                ]
            });
        });

        function confirmMsg()
        {
            var answer = confirm("Delete selected record?")
            if (answer){
                return true;
            }
            return false;
        }

        // function deletebuildercategory(id){
        //
        // }
    </script>
@endpush
@endsection
