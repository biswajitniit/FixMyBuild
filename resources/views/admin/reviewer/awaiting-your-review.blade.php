@extends('layouts.admin')
@section('title', 'Awaiting your review')
@section('content')


<div class="main-panel">
    <div class="content-wrapper pb-0">
        <div class="page-header">
            <h3 class="page-title">Awaiting your review</h3>
            <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                {{-- <button type="button"  class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                  <i class="mdi mdi-plus-circle"></i> Submitted For Review </button> --}}
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
                <h4 class="card-title">Awaiting your review</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-none" id="my-table">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th>Name</th>
                                        <th>Posting date</th>
                                        <th>Status</th>
                                        <th>Reviewer Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project as $projects)
                                    <tr>
                                        <td>{{ $projects->forename.' '.$projects->surname }}</td>
                                        <td>{{ date('d/m/Y h:i a',strtotime($projects->created_at)) }}</td>
                                        <td>{{ str_replace("_", " ", $projects->status) }}</td>
                                        <td> @if($projects->reviewer_status == "Refer") <p class="btn btn-danger">Refer</p> @elseif($projects->reviewer_status == "Approve") <p class="btn btn-success">Approve</p> @else <p class="btn btn-warning active">Pending</p> @endif </td>
                                        <td><a href="{{route('awaiting-your-review-show',[Hashids_encode($projects->id)])}}" title="View Projects"><i class="mdi mdi-eye"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © {{ date('Y') }} <a href="{{ url('/') }}" target="_blank">FixMyBuild</a>. All rights reserved.</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<!-- main-panel ends -->







@push('scripts')
<script type="text/javascript">
    // $(document).ready(function(){
    //     // DataTable
    //         $('#my-table').DataTable({
    //             processing: true,
    //             serverSide: true,
    //             lengthMenu: [[100, 200, 300], [100, 200, 300]],
    //             order: [[ 0, "asc" ]],
    //             columnDefs: [{
    //                 "searchable": true,
    //                 "orderable": false,
    //                 "targets": 0
    //             }],
    //             "ajax": {
    //                 data: ({_token: '{{csrf_token()}}'}),
    //                 url : "{{route('admin.user-list-datatable')}}",
    //                 type : 'GET',
    //             },
    //             columns: [
    //                     {data: 'name' },
    //                     {data: 'email' },
    //                     {data: 'phone' },
    //                     {data: 'customer_or_tradesperson' },

    //                     {
    //                         data: 'status',
    //                         render: function (data, type, row){
    //                             if(data == "Active"){
    //                                 return '<label class="badge badge-success">Active</label>';
    //                             }else{
    //                                 return '<label class="badge badge-danger">In Active</label>';
    //                             }
    //                         },
    //                     },
    //                    {
    //                         data: 'action',
    //                         render: function (data, type, row){
    //                             return '<a href="" title="Edit User"><i class="mdi mdi-table-edit"></i></a>';
    //                         },
    //                     },

    //             ]
    //         });
    //     });

    //     function confirmMsg(e)
    //     {
    //         var answer = confirm("Are you sure you want to delete this record?")
    //         if (answer){
    //             return true;
    //         }
    //         e.preventDefault();
    //     }

</script>
@endpush
@endsection
