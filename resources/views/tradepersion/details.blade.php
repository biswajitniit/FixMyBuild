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
                @case('project_paused')
                    <span class="text-warning">Project paused</span>
                    @break
                @case('estimate_not_accepted')
                    <span class="text-danger">Estimate not accepted</span>
                    @break
                @case('project_completed')
                    <span class="text-success">Project Completed</span>
                    @break
                @case('project_cancelled')
                    <span class="text-danger">Project Cancelled</span>
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
     @php $is_media_present = false; $count = 0; @endphp
     <div class="col-md-12">
        <h3>Photo(s)/Video(s)</h3>

        <div class="row">
            <div class="pv_top">
                @foreach($projectid as $doc)
                    @if (strtolower($doc->file_type) == 'image')
                        <a href="javascript:void(0);"  onclick="openModal({{ $count }}, 'details-modal-element')">
                            <img src="{{ $doc->url }}" class="rectangle-img details-modal-element"/>
                        </a>
                        @php $is_media_present = true; $count++; @endphp
                    @endif
                    @if (strtolower($doc->file_type) == 'video')
                        <div class="video-mask" onclick="openModal({{ $count }}, 'details-modal-element')" title="View video">
                            <div class="video-overlay">
                                <img src="{{ asset('adminpanel/assets/images/play_btn.svg') }}" alt="Video" class="image-wrapper">
                                <video width="100" height="69" src="{{ $doc->url }}" class="rectangle-video details-modal-element">  </video>
                                <div class="semi-transparent"></div>
                            </div>
                        </div>
                        @php $is_media_present = true; $count++; @endphp
                    @endif
                @endforeach

                @if(!$is_media_present)
                    No photo/video is uploaded.
                @endif
            </div>
        </div>
     </div>

     @php $is_document_present = false; @endphp
     <div class="col-md-12 mt-4">
        <h3>Files(s)</h3>
        <div class="row">
            <div class="mt-3">
                @foreach($projectid as $doc)
                     @if(strtolower($doc->file_type) == 'document')
                         @php $is_document_present=true; @endphp
                         <div class="d-inline mr-4 img-text">
                            <a href="{{$doc->url}}" target="_blank" class="hover-transition-off file-logo"><svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3125 0H5.6875C4.72106 0 3.9375 0.727594 3.9375 1.625V24.375C3.9375 25.2724 4.72106 26 5.6875 26H22.3125C23.2789 26 24.0625 25.2724 24.0625 24.375V8.12541L15.3125 0ZM22.3125 8.79856V8.9375H14.4375V1.625H14.588L22.3125 8.79856ZM5.6875 24.375V1.625H12.6875V10.5625H22.3125V24.375H5.6875Z" fill="#EE5719"/>
                                </svg> {{$doc->filename}}
                            </a>
                         </div>
                     @endif
                 @endforeach

                 @if(!$is_document_present)
                     No file is uploaded
                 @endif
            </div>
        </div>
     </div>
 </div>
