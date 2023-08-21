<div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th style="width:80px;">#</th>
          <th style="width:350px;">Name</th>
          <th style="width:150px;">Posting date</th>
          <th style="width:300px;">Status</th>
          <th style="width:auto;"></th>
        </tr>
      </thead>
      <tbody id="table_body">
        @forelse ($estimate_projects as $key=>$estimate_proj)
            @php
                $projectStatus = tradesperson_project_status($estimate_proj->id);
            @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{  ucwords($estimate_proj->project_name) }}</td>
                <td>
                    {{ $estimate_proj->created_at->format('d/m/Y') }} <br>
                    <em>{{ $estimate_proj->created_at->format('g:i A') }}</em>
                </td>
                <td>
                    @if ($projectStatus == 'write_estimate')
                        <span class="text-primary">Write estimate</span>
                    @elseif ($projectStatus == 'estimate_recalled')
                        <span class="text-warning">Estimate recalled</span>
                    @elseif ($projectStatus == 'estimate_submitted')
                        <span class="text-info">Estimate submitted</span>
                    @elseif ($projectStatus == 'estimate_rejected')
                        <span class="text-danger">Estimate rejected</span>
                    @elseif ($projectStatus == 'estimate_not_accepted')
                        <span class="text-danger">Estimate not accepted</span>
                    @elseif ($projectStatus == 'estimate_accepted')
                        <span class="text-success">Estimate accepted</span>
                    @elseif ($projectStatus == 'need_more_info')
                        <span class="text-primary">Need more info</span>
                    @else
                        <span>&nbsp;</span>
                    @endif
                </td>
                <td>
                    {{-- <a href="#" class="btn btn-view">View</a> --}}
                    <a href="{{ route('tradeperson.project_details', ['project_id' => Hashids_encode($estimate_proj->id)]) }}" class="btn btn-view">View</a>
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
{{-- <div class="col-12 justify-content-center">
    <div class="pagination">
        {{ $estimate_projects->onEachSide(3)->links('includes.pagination') }}
    </div>
</div> --}}
