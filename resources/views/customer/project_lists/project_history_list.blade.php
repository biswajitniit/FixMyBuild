<div class="white_bg">
    <div class="row num_change">
        <div class="col-md-12">
            <h3>Project history</h3>
        </div>
    </div>
    <div class="row table_wrap">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width:80px;">#</th>
                        <th style="width:200px;">Name</th>
                        <th style="width:200px;">Posting date</th>
                        <th style="width:220px;">Status</th>
                        <th style="width:80px;"></th>
                        <th style="width:auto;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projecthistory as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucwords($row->project_name) }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->created_at))}} <br> <em> {{ date('h:i a',strtotime($row->created_at))}} </em> </td>
                            <td>
                            @switch($row->status)
                                @case('project_cancelled')
                                    <span class="text-danger">Project Cancelled</span>
                                    @break
                                @case('project_paused')
                                    <span class="text-warning">Project Paused</span>
                                    @break
                                @case('project_completed')
                                    <span class="text-success">Project Completed</span>
                                    @break
                            @endswitch
                            </td>
                            <td></td>
                            <td>
                                @if ($row->status === 'project_completed')
                                    <a href="{{route('customer.project_review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                @else
                                    <a href="{{route('customer.project_details',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No Project History Available.</td>
                        </tr>
                    @endforelse
                 </tbody>
             </table>
        </div>
    </div>
</div>
