<div class="tab-pane fade @if ($status == 'submitted_for_review')active show @endif" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
    <div class="row mb-3">
        <div class="col-md-8">
            @if ($status == 'project_started' || $status == 'awaiting_your_review')
                <div class="mb-3">
                    <h2>Tradesperson</h2>
                    <h3 class="titel">Wade Warren</h3>
                    <div class="d-inline mr-3 info_"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.51667 6.99167C4.71667 9.35 6.65 11.275 9.00833 12.4833L10.8417 10.65C11.0667 10.425 11.4 10.35 11.6917 10.45C12.625 10.7583 13.6333 10.925 14.6667 10.925C15.125 10.925 15.5 11.3 15.5 11.7583V14.6667C15.5 15.125 15.125 15.5 14.6667 15.5C6.84167 15.5 0.5 9.15833 0.5 1.33333C0.5 0.875 0.875 0.5 1.33333 0.5H4.25C4.70833 0.5 5.08333 0.875 5.08333 1.33333C5.08333 2.375 5.25 3.375 5.55833 4.30833C5.65 4.6 5.58333 4.925 5.35 5.15833L3.51667 6.99167Z" fill="#EE5719"></path>
                        </svg>
                        +447975777666</div>
                    <div class="d-inline mr-3 info_"><svg width="18" height="14" viewBox="0 0 18 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.668 3.66683L9.0013 7.8335L2.33464 3.66683V2.00016L9.0013 6.16683L15.668 2.00016M15.668 0.333496H2.33464C1.40964 0.333496 0.667969 1.07516 0.667969 2.00016V12.0002C0.667969 12.4422 0.843563 12.8661 1.15612 13.1787C1.46868 13.4912 1.89261 13.6668 2.33464 13.6668H15.668C16.11 13.6668 16.5339 13.4912 16.8465 13.1787C17.159 12.8661 17.3346 12.4422 17.3346 12.0002V2.00016C17.3346 1.55814 17.159 1.13421 16.8465 0.821651C16.5339 0.509091 16.11 0.333496 15.668 0.333496Z" fill="#EE5719"></path>
                        </svg>
                        wade-warren@gmail.com</div>
                </div>
                <h3>Project</h3>
            @elseif ($status == 'estimation')
                <h2>Project</h2>
            @endif
            <h6>Status:
            @switch($status)
                @case('submitted_for_review')
                    <span class="text-info">Submitted for review</span>
                    @break
                @case('returned_for_review')
                    <span class="text-dark">Returned for review</span>
                    @break
                @case('estimation')
                    <span class="text-primary">View estimates</span>
                    @break
                @case('project_started')
                    <span class="text-success">Project started</span>
                    @break
                @case('awaiting_your_review')
                    <span class="text-awaiting">Awaiting your review</span>
                    @break
            @endswitch
            </h6>
        </div>
        <div class="col-md-4 text-right"><h6>Posted on: <span class="date_time">{{ $projects->created_at->format('d M Y,  H:i A') }}</span> </h6></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {{htmlspecialchars(trim(strip_tags($projects->description)))}}
        </div>
    </div>

    @php $is_media_present = false; @endphp
    <div class="col-md-12">
        <h3>Photo(s)/Video(s)</h3>
        <div class="row">
            <div class="pv_top">
                @foreach($doc as $docs)
                    @if (strtolower($docs->file_type) == 'image')
                        @php $is_media_present = true; @endphp
                        <a href="javascript:void(0);">
                            <img src="{{ $docs->url }}" />
                        </a>
                    @endif
                    @if (strtolower($docs->file_type) == 'video')
                        @php $is_media_present = true; @endphp
                        <div class="video-mask">
                            <a href="javascript:void(0);">
                                <video width="100" height="69" src="{{ $docs->url }}" >  </video>
                            </a>
                        </div>
                    @endif
                @endforeach

                @if(!$is_media_present)
                    No photo/video is uploaded
                @endif
            </div>
        </div>
    </div>

    @php $is_document_present = false; @endphp
    <div class="col-md-12 mt-4">
        <h3>File(s)</h3>
        <div class="row">
            <div class="mt-2">
                @foreach($doc as $docs)
                    @if(strtolower($docs->file_type) == 'document')
                        @php $is_document_present=true; @endphp
                        <div class="d-inline mr-4 img-text">
                            <a href="{{$docs->url}}" target="_blank"><img src="{{ asset("frontend/img/pdf-icon.svg") }}" alt=""> {{$docs->filename}}</a>
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
