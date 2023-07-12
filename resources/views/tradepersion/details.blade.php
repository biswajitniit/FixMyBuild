<div class="tab-pane fade @if (tradesperson_project_status($project->id) == 'write_estimate')active show @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <div class="row mb-3">
        <div class="col-md-8">
        <h3>Project</h3>
        <h6>Status: <span class="text-primary">Write Estimate</span></h6></div>
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
                    <div class="col-4 col-md-2">
                        <a href="#gallery-1" class="btn-gallery">
                            <img src="{{ asset($project_file->url) }}" alt="" />
                        </a>
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
            </div>
        </div>
     </div>
 </div>
