<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width:80px;">#</th>
                <th style="width:300px;">Name</th>
                <th style="width:150px;">Posting date</th>
                <th style="width:300px;">Status</th>
                <th style="width:auto;"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estimate_project_histories as $key=>$estimate_proj)
                @php
                    $projectStatus = tradesperson_project_status($estimate_proj->id);
                @endphp
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $estimate_proj->project_name }}</td>
                    <td>
                        {{ $estimate_proj->created_at->format('d/m/Y') }} <br>
                        <em>{{ $estimate_proj->created_at->format('g:i A') }}</em>
                    </td>
                    <td>
                        @if ($projectStatus == 'project_cancelled')
                            <span class="text-danger">Project cancelled</span>
                        @elseif ($projectStatus == 'project_paused')
                            <span class="text-orange">Project paused</span>
                        @elseif ($projectStatus == 'project_completed')
                            <span class="text-success">Project completed</span>
                        @else
                            <span>&nbsp;</span>
                        @endif
                    </td>
                    <td>
                        {{-- <a href="#" class="btn btn-view">View</a> --}}
                        <a href="{{ route('tradeperson.project_details', ['project_id' => $estimate_proj->id]) }}" class="btn btn-view">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Projects Available For You Right Now.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- <div class="col-12 justify-content-center">
    <div class="pagination">
        {{ $estimate_project_histories->onEachSide(3)->links('includes.pagination') }}
    </div>
</div> --}}
