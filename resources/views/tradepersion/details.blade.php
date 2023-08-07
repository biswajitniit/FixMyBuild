<div class="tab-pane fade @if ($projectStatus == 'write_estimate'||$projectStatus == 'project_completed' || $projectStatus == 'project_paused' || tradesperson_project_status($project->id) == 'project_cancelled' || $projectStatus == 'need_more_info')active show @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <div class="row mb-3">
        <div class="col-md-8">
        <h3>Project</h3>
        <h6>Status:
            @switch($projectStatus)
                @case('estimate_submitted')
                    <span class="text-info">Estimate submitted</span>
                    @break
                @case('write_estimate')
                    <span class="text-primary">Write estimate</span>
                    @break
                @case('need_more_info')
                    <span class="text-primary">Need more info</span>
                    @break
                @case('project_started')
                    <span class="text-success">Project started</span>
                    @break
                @case('estimate_accepted')
                    <span class="text-awaiting">Estimate accepted</span>
                    @break
                @case('estimate_rejected')
                    <span class="text-awaiting">Estimate rejected</span>
                    @break
                @case('estimate_recalled')
                    <span class="text-awaiting">Estimate recalled</span>
                    @break
                @case('estimate_not_accepted')
                    <span class="text-danger">Estimate not accepted</span>
                    @break
            @endswitch
        </h6>
    </div>
        <div class="col-md-4 text-right"><h6>Posted on: <span class="date_time">{{ $project->created_at->format('d M Y,  H:i A') }}</span> </h6></div>
     </div>

     <div class="row">
        {{-- @foreach($projects as $project_data)
        <div class="col-md-12">
           {{!! $project_data->description !!}}
        </div>
        @endforeach --}}
        <div class="col-md-12">
            <p>{{htmlspecialchars(trim(strip_tags($project->description)))}}<p>
         </div>
     </div>
     <div class="col-md-12">
        <h3>Photo(s)/Video(s)</h3>

        <div class="row">
            <div class="pv_top">
                @forelse($projectid as $doc)
                    @if (strtolower($doc->file_type) == 'image')
                        <a href="javascript:void(0);">
                            <img src="{{ $doc->url }}" class="rectangle-img" />
                        </a>
                    @endif
                    @if (strtolower($doc->file_type) == 'video')
                        <div class="video-mask">
                            <a href="javascript:void(0);">
                                <video width="100" height="69" src="{{ $doc->url }}" class="rectangle-video" >  </video>
                            </a>
                        </div>
                    @endif
                @empty
                    No photo/video is uploaded.
                @endforelse
            </div>
        </div>
     </div>
     <div class="col-md-12 mt-4">
        <h3>Files(s)</h3>
        <div class="row">
            <div class="mt-3">
                @forelse($projectid as $data)
                    <div class="d-inline mr-4 img-text">
                        <a href="{{ $data->url }}" target="_blank">
                            {{ $data->filename }}
                        </a>
                    </div>
                @empty
                    No file is uploaded.
                @endforelse
            </div>
        </div>
     </div>
 </div>
