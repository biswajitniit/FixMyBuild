<div class="tab-pane fade" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <div class="row mb-3">
        <div class="col-md-8">
            <h3>Project</h3>
            <h6>Status:
                @switch($status)
                    @case('estimate_submitted')
                        <span class="text-info">Submitted for review</span>
                        @break
                    @case('returned_for_review')
                        <span class="text-dark">Returned for review</span>
                        @break
                    @case('estimation')
                        <span class="text-primary">View estimate</span>
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

     @php $is_media_present = false; @endphp
     <div class="col-md-12">
         <h3>Photo(s)/Video(s)</h3>
         <div class="row">
             <div class="pv_top">
                 @foreach($projectfiles as $doc)
                     @if (strtolower($doc->file_type) == 'image')
                         @php $is_media_present = true; @endphp
                         <a href="javascript:void(0);">
                             <img src="{{ $doc->url }}" class="rectangle-img"/>
                         </a>
                     @endif
                     @if (strtolower($doc->file_type) == 'video')
                         @php $is_media_present = true; @endphp
                         <div class="video-mask">
                             <a href="javascript:void(0);">
                                 <video width="100" height="69" src="{{ $doc->url }}" class="rectangle-video" >  </video>
                             </a>
                         </div>
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
         <h3>File(s)</h3>
         <div class="row">
             <div class="mt-2">
                 @foreach($projectid as $doc)
                     @if(strtolower($doc->file_type) == 'document')
                         @php $is_document_present=true; @endphp
                         <div class="d-inline mr-4 img-text">
                             <a href="{{$doc->url}}" target="_blank"><img src="{{ asset("frontend/img/pdf-icon.svg") }}" alt=""> {{$doc->filename}}</a>
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
