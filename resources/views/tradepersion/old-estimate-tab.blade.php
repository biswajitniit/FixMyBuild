<div class="tab-pane fade @if ($projectStatus == 'estimate_rejected' || $projectStatus == 'estimate_not_accepted')active show @endif" id="nav-old-estimate" role="tabpanel" aria-labelledby="nav-old-estimate-tab">
    <div class="row mb-5">
       <div class="col-md-8">
          <img src="{{ $company_logo->url ?? asset('frontend/img/company_logo.svg') }}" alt="" class="mr-2 c_logo"> <span>{{ $trader_detail->comp_name }}</span>
       </div>
       <div class="col-md-4 text-right mt-4">
          <h6>Posted on: <span class="date_time">{{ $estimate->created_at->format('d M Y,  H:i A') }}</span> </h6>
       </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h2>Milestones details</h2>
            @foreach($tasks as $key=>$task)
                @if($task->is_initial == 0)
                    <h3>
                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z" fill="#061A48"/>
                        </svg>
                        Milestone {{ $key+1 }}
                    </h3>
                    <p>{{ $task->description }}</p>
                @endif
            @endforeach
            @php $is_media_present = false; $count = 0; @endphp
            <div class="col-md-12 mb-5">
               <h3>Photo(s)/Video(s)</h3>
               <div class="row">
                  <div class="pv_top">
                      @foreach($proj_estimate_files as $doc)
                          @if (strtolower($doc->file_type) == 'image')
                              <a class="mb-3" href="javascript:void(0);"  onclick="openModal({{ $count }}, 'old-estimate-modal-element')">
                                  <img src="{{ $doc->url }}" class="rectangle-img old-estimate-modal-element"/>
                              </a>
                              @php $is_media_present = true; $count++; @endphp
                          @endif
                          @if (strtolower($doc->file_type) == 'video')
                              <div class="video-mask" onclick="openModal({{ $count }}, 'old-estimate-modal-element')" title="View video">
                              <div class="video-overlay">
                                  <img src="{{ asset('adminpanel/assets/images/play_btn.svg') }}" alt="Video" class="image-wrapper">
                                  <video width="100" height="69" src="{{ $doc->url }}" class="rectangle-video old-estimate-modal-element">  </video>
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
          <h3>
             <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 19.25V16.5938L18.625 9.96875L21.2812 12.625L14.6562 19.25H12ZM0.75 13V10.5H9.5V13H0.75ZM22.1562 11.75L19.5 9.09375L20.4062 8.1875C20.6354 7.95833 20.9271 7.84375 21.2812 7.84375C21.6354 7.84375 21.9271 7.95833 22.1562 8.1875L23.0625 9.09375C23.2917 9.32292 23.4062 9.61458 23.4062 9.96875C23.4062 10.3229 23.2917 10.6146 23.0625 10.8438L22.1562 11.75ZM0.75 8V5.5H14.5V8H0.75ZM0.75 3V0.5H14.5V3H0.75Z" fill="#061A48"/>
             </svg>
             Note
          </h3>
            @if($estimate->covers_customers_all_needs == 1)
                <p><ul><li>The above list of tasks cover all of the work requested under this project.</li></ul></p>
            @endif

            @if($estimate->payment_required_upfront == 1)
                <p><ul><li>Upfront payment required:  Yes</li></ul></p>
            @else
                <p><ul><li>Upfront payment required:  No</li></ul></p>
            @endif

            @if($estimate->apply_vat == 1)
                <p><ul><li>This estimate includes VAT.</li></ul></p>
            @else
                <p><ul><li>This estimate does not includes VAT.</li></ul></p>
            @endif

          <h3>Costing of entire project</h3>
          <div class="row cnp_">
             <div class="col-md-5 mt-4 mb-4">
                <div class="cnp_border">
                   <h6>Cost breakdown including contingency</h6>
                </div>
                @if($estimate->payment_required_upfront == 1)
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                            Initial payment
                        </div>
                        <div class="col-6">
                            @foreach($tasks as $key=>$task)
                                @if($task->is_initial == 1)
                                    <span>£{{ $task->price }}</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="row mt-4 mb-3 cost_b">
                    @foreach($tasks as $key=>$task)
                        @if($task->is_initial == 0)
                            <div class="col-6 mt-2">
                                Milestone {{ $key+1 }}
                            </div>
                            <div class="col-6 mt-2">
                                @if (intval($task->price) == $task->price)
                                    <span>£{{ intval($task->price) }}</span>
                                @else
                                    <span>£{{ number_format($task->price, 2) }}</span>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
             </div>
             <div class="col-md-6 offset-md-1 mt-4 total-price">
                <h6>Total price excluding contingency</h6>
                @if ($taskTotalAmount == (int) $taskTotalAmount)
                    <div class="mb-5 price_ec">£{{ (int) $taskTotalAmount }}</div>
                @else
                    <div class="mb-5 price_ec">£{{ number_format($taskTotalAmount, 2) }}</div>
                @endif

                <h5>Contingency: {{ $estimate->contingency }}%</h5>
                <h6>Total price including contingency</h6>
                @if ($taskAmountWithContingency == (int) $taskAmountWithContingency)
                    <div class="price_ec">£{{ (int) $taskAmountWithContingency }}</div>
                @else
                    <div class="price_ec">£{{ number_format($taskAmountWithContingency, 2) }}</div>
                @endif

                @if( $estimate->apply_vat == 1)
                    <h6 class="mt-5">Total price including contingency and VAT</h6>
                    @if ($taskAmountWithContingencyAndVat == (int) $taskAmountWithContingencyAndVat)
                        <div class="price_ec">£{{ (int) $taskAmountWithContingencyAndVat }}</div>
                    @else
                        <div class="mb-5 price_ec">£{{ number_format($taskAmountWithContingencyAndVat, 2) }}</div>
                    @endif
                @else
                @endif
            </div>
          </div>
            <h3>Estimated time required to complete the project:</h3>
            <div class="row">
                <div class="col-3 mt-2">
                    <small>{{ $estimate->total_time_type }}</small>
                    <div class="price_ec">{{ $estimate->total_time }}</div>
                </div>

                <div class="col-6 mt-2">
                    <small>Available to start</small>
                    @if($estimate->project_start_date == null)
                        <div class="price_ec">{{ str_replace('_', ' ', \Str::title($estimate->project_start_date_type)) }}</div>
                    @else
                        <div class="price_ec">{{ date('d-m-Y',strtotime($estimate->project_start_date)) }}</div>
                    @endif
                </div>
            </div>
            <h3>Terms and conditions</h3>
                <div class="col-md-12">
                    <p>{{ $estimate->terms_and_conditions }}</p>
                </div>
       </div>
    </div>
</div>
