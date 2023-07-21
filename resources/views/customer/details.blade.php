<div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <div class="row mb-3">
        <div class="col-md-8">
            <h3>Project</h3>
            <h6>Status:
                @switch($status)
                    @case('submitted_for_review')
                        <span class="text-info">Submitted for review</span>
                        @break
                    @case('returned_for_review')
                        <span class="text-dark">Returned for review</span>
                        @break
                    @case('estimation')
                        <span class="text-primary">Write estimate</span>
                        @break
                    @case('project_started')
                        <span class="text-success">Project started</span>
                        @break
                    @case('awaiting_your_review')
                        <span class="text-awaiting">Awaiting your review</span>
                        @break
                @endswitch
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
                    @foreach($projectfiles as $projectfile)
                        <div class="col-4 col-md-2 text-center">
                            @if(strtolower($projectfile->file_type) === 'image')
                                <a href="{{ $projectfile->url }}" class="btn-gallery" target="_blank">
                                    <img src="{{ $projectfile->url }}" alt="">
                                </a>
                            @endif
                            @if(strtolower($projectfile->file_type) === 'video')
                                <video src="{{ $projectfile->url }}" controls="controls" class="rectangle-img mt-0"></video>
                            @endif
                        </div>
                    @endforeach

                    <div id="gallery-1" class="hidden">
                        <a href="assets/img/Rectangle 63b.jpg">Image 1</a>
                        <a href="assets/img/Rectangle 62b.jpg">Image 1</a>
                        <a href="assets/img/Group 296b.jpg">Image 1</a>
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
            </div>
        </div>
     </div>
 </div>
