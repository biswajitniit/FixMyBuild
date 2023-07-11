<div class="tab-pane fade active show" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
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
                 <div class="col-4 col-md-2">
                     <a href="#gallery-1" class="btn-gallery">
                         <img src="assets/img/Rectangle 63.jpg" alt="" />
                     </a>
                 </div>
                 <div class="col-4 col-md-2">
                     <a href="#gallery-1" class="btn-gallery">
                         <img src="assets/img/Rectangle 62.jpg" alt="" />
                     </a>
                 </div>
                 <div class="col-4 col-md-2">
                     <a href="#gallery-1" class="btn-gallery">
                         <img src="assets/img/Group 296.jpg" alt="" />
                     </a>
                 </div>

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
        @foreach($projectid as $data)
        <h3>Files(s)</h3>
        <div class="row">
           <div class="mt-3">
              <div class="d-inline mr-4 img-text">{{ $data->filename }}</div>
              {{-- <div class="d-inline mr-4 img-text"><img src="" alt=""> xyz.doc</div>
              <div class="d-inline mr-4 img-text"><img src="" alt=""> pqr.xls</div> --}}
           </div>
        </div>
        @endforeach
     </div>
 </div>
