@extends('layouts.admin')
@section('title', 'User List')
@section('content')


<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">User List</h3>
            <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <button type="button"  class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> User List </button>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif



        <!-- first row starts here -->


        <div class="card">
            <div class="card-body">
                <h4 class="card-title">User's</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-none" id="my-table">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>User Type</th>
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

        <div id="myModal" class="modal fade" role="dialog" >
            <div class="modal-dialog" style="width:700px;max-width:initial;height:500px;">
            <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-body">

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
                    url : "{{route('admin.user-list-datatable')}}",
                    type : 'GET',
                },
                columns: [
                        {data: 'name' },
                        {data: 'email' },
                        {data: 'phone' },
                        {data: 'customer_or_tradesperson' },

                        {
                            data: 'status',
                            render: function (data, type, row){
                                if(data[0] == "Active"){
                                    return `<button type="button" class="badge badge-success" onclick="toggleStatus(this, '${data[1]}')">Active</button>`;
                                }else{
                                    return `<button type="button" class="badge badge-danger" onclick="toggleStatus(this, '${data[1]}')">Inactive</button>`;
                                }
                            },
                        },
                       {data: 'action'},
                ]
            });
        });

        function confirmMsg(e)
        {
            var answer = confirm("Are you sure you want to delete this record?")
            if (answer){
                return true;
            }
            e.preventDefault();
        }

        function toggleStatus(e, data_id)
        {
            let status = "active";
            if ($(e).text().trim().toLowerCase() == status)
                status = "Inactive";
            else
                status = "Active";
            $.ajax({
                url: "{{route('admin.toggle-status', '')}}"+"/"+data_id,
                type: "patch",
                data: {
                    _token: "{{ csrf_token() }}",
                    status : status,
                },
                success: function(response) {
                    if(response.status.toLowerCase() == 'active'){
                        $(e).removeClass('badge-danger');
                        $(e).addClass('badge-success');
                    } else {
                        $(e).removeClass('badge-success');
                        $(e).addClass('badge-danger');
                    }
                    $(e).text(response.status);
                }
            });
        }

</script>
@endpush
@endsection
