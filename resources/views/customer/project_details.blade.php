@extends('layouts.app')

@section('content')
<!--Code area start-->

     <section>
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center pt-5 fmb_titel">
                  <h1>Project</h1>
                  <ol class="breadcrumb mb-5">
                     <li class="breadcrumb-item"><a href="{{url('/customer/profile')}}">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{url('/customer/projects')}}">Project list</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Details</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <!--Code area end-->
      <!--Code area start-->     
      <section class="pb-5">
         <div class="container">
            <form action="#" method="post">
               <div class="row mb-5">
                  <div class="col-md-10 offset-md-1">
                     <div class="tell_about pl-details">                    
                        <div class="row">
                            <div class="col-md-6"><h5>Customer’s project name</h5></div>
                            <div class="col-md-6"><h2>{{$projects->project_name}}</h2></div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6"><h5>Location</h5></div>
                            <div class="col-md-6"><h2>{{$projectaddress->town_city}}</h2></div>
                        </div>
                     </div>
                  </div>
               </div>
               <!--// END-->
               @php
                 $status=$projects->status;
                 $status = str_replace('_', ' ', $status);
                 $status = ucfirst(trans($status));
                 @endphp
               <div class="row">
                  <div class="col-md-10 offset-md-1">
                     <div class="card card-wrap">
                        <div class="card-header">Details</div>
                        <div class="card-body">
                           <div class="row mb-3">
                              <div class="col-md-8"><h6>Status: <span class="text-info">{{$status}}</h6></div>
                              <div class="col-md-4 text-right"><h6>Posted on: <span class="date_time">{{ $projects->created_at->format('d M Y,  H:i A') }}</span> </h6></div>
                           </div>
                           
                           <div class="row">
                              <div class="col-md-12">
                                    {!!$projects->description!!}
                              </div>
                           </div>
                           <div class="col-md-12">
                              <h3>Photo(s)/Video(s)</h3>
                              <div class="row">
                                 <div class="pv_top">
                                 @foreach($doc as $docs)
                                 @if($docs->file_type=='video'||$docs->file_type=='image')
                                 
                                 <a href="#" data-bs-toggle="modal" data-bs-target="#profile_pics"><img src="{{$docs->url}}" alt=""  width="150" height="0"  /></a>
                                 
                                 
                                 <!-- The Modal Change profile photo-->
                            <div class="modal fade select_address" id="profile_pics" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header pb-0">
                                        
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                        fill="black"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 supported_">                              
                                                    <div>
                                                        <img src="{{$docs->url}}" alt="" />   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- The Modal Change profile photo END-->
                            @endif
                           @endforeach
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-12 mt-4">
                              <h3>Files(s)</h3>
                              
                              <div class="row">
                                 <div class="mt-2">
                                 @foreach($doc as $docs)
                                 @if($docs->file_type=='document')
                                 
                                    <div class="d-inline mr-4 img-text"><a href="{{$docs->url}}" target="_blank"><img src="" alt="">{{$docs->filename}}</a></div>
                                    @endif
                                    @endforeach
                                 </div>
                              </div>
                              
                           </div>
                        </div> 
                      </div>
                     <div class="form-group col-md-12 mt-5 text-center">
                        <a href="{{url('/customer/projects')}}" class="btn btn-primary">Back</a>
                     </div>
                  </div>
               </div>
               <!--// END-->
            </form>
         </div>
         
      </section>
      

      <!--Code area end-->
      @endsection
      
      