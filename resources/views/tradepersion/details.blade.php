<div class="tab-pane fade @if ($projectStatus == 'write_estimate'||$projectStatus == 'project_completed' || $projectStatus == 'project_paused' || tradesperson_project_status($project->id) == 'project_cancelled')active show @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
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

        <div class="row gallery-area1">
           <div class="pv_top gallery-wrapper">
             <div class="row">
                @foreach($projectid as $project_file)
                    <div class="col-4 col-md-2 text-center">
                        @if(strtolower($project_file->file_type) === 'image')
                            <a href="{{ $project_file->url }}" class="btn-gallery" target="_blank">
                                <img src="{{ $project_file->url }}" alt="">
                            </a>
                        @endif
                        @if(strtolower($project_file->file_type) === 'video')
                            <video src="{{ $project_file->url }}" controls="controls" class="rectangle-img mt-0"></video>
                        @endif
                    </div>
                @endforeach
                <div id="gallery-1" class="hidden">
                     <a href="assets/img/Rectangle 63b.jpg">Image 1</a>
                 </div>
             </div>
           </div>
        </div>

     </div>
     <div class="col-md-12 mt-4">
        <h3>Files(s)</h3>
        <div class="row">
            <div class="mt-3">
                @foreach($projectid as $data)
                    <div class="d-inline mr-4 img-text">{{ $data->filename }}</div>
                @endforeach
                @if($data->filename == null)
                    No file is uploaded
                @endif
            </div>
        </div>
     </div>
 </div>
