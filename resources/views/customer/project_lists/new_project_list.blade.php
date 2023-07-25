<div class="white_bg mb-5">
    <div class="row num_change">
        <div class="col-md-12">
            <h3>
                New project(s)
                @env(['staging', 'development'])
                    <span>
                        <a href="{{ route('customer.newproject') }}"> <i class="fa fa-plus"></i> Add new</a>
                    </span>
                @endenv
            </h3>
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
                    @forelse ($project as $key=>$row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ ucwords($row->project_name) }}</td>
                            <td>{{ date('d/m/Y',strtotime($row->created_at))}} <br> <em> {{ date('h:i a',strtotime($row->created_at))}} </em> </td>
                            <td>
                                @switch($row->status)
                                    @case('submitted_for_review')
                                        <span class="text-info">Submitted for review</span>
                                        @break
                                    @case('returned_for_review')
                                        <span class="text-dark">Returned for review</span>
                                        @break
                                    @case('estimation')
                                        <span class="text-primary">View estimates</span>
                                        @break
                                    @case('project_started')
                                        <span class="text-success">Project started</span>
                                        @break
                                    @case('awaiting_your_review')
                                        <span class="text-awaiting">Awaiting your feedback</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                @if ($row->status === 'project_started')
                                    <a href="#"><img src="{{ asset('frontend/img/chat-info.svg') }}" alt=""></a>
                                @endif
                            </td>
                            <td>
                                @if ($row->status === 'awaiting_your_review')
                                    <a href="{{route('customer.project_review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                @elseif (Str::lower($row->status) === 'returned_for_review')
                                    <a href="{{route('customer.project-return-for-review', [Hashids_encode($row->id)] )}}" class="btn btn-view">View</a>
                                @else
                                <a href="{{route('customer.project_details',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a>
                                    {{-- <a href="{{route('customer.project-return-for-review',[Hashids_encode($row->id)])}}" class="btn btn-view">View</a> --}}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">There are currently no running projects.</td>
                        </tr>
                    @endforelse
                </tbody>
             </table>
        </div>
    </div>
</div>
