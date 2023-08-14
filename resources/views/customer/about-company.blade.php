<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="row mb-5">
        <div class="col-md-8">
            <img src="{{ $company_logo->url ?? asset('frontend/img/company_logo.svg') }}" alt="" class="mr-2 c_logo"><span>{{ $trader_detail->comp_name }}</span>
        </div>
       <div class="col-md-4 text-right mt-4">
          <h6>Posted on: <span class="date_time">{{ $trader_detail->created_at->format('d M Y,  H:i A') }}</span></h6>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12 about_company">
            <h3>
                Details
            </h3>
            <p>{{ htmlspecialchars(trim(strip_tags($trader_detail->comp_description))) }}</p>
            @if($trader_detail->vat_no != null)
                <h3>UK VAT number</h3>
                <h4>{{ $trader_detail->vat_no }}</h4>
            @endif
            <div class="row">
             <div class="col-md-6">
                <h3>Team photo(s)</h3>
                <div class="row">
                    <div class="pv_top">
                        @forelse($teams_photos as $teams_photo)
                            <div class="d-inline mr-3">
                                <a href="{{ $teams_photo->url }}" target="_blank">
                                    <img src="{{ $teams_photo->url }}" alt="" class="rectangle-img mb-2">
                                </a>
                            </div>
                        @empty
                            <div>No photo is uploaded.</div>
                        @endforelse
                    </div>
                </div>
             </div>
             <div class="col-md-6">
                <h3>Photo(s) of previous project(s)</h3>
                <div class="row">
                    <div class="pv_top">
                        @forelse($prev_project_imgs as $prev_project_img)
                            <div class="d-inline mr-3">
                                <a href="{{ $prev_project_img->url }}" target="_blank">
                                    <img src="{{ $prev_project_img->url }}" alt="" class="rectangle-img">
                                </a>
                            </div>
                        @empty
                            <div>No photo is uploaded.</div>
                        @endforelse
                    </div>
                </div>
             </div>
          </div>
        @if($project_reviews && count($project_reviews) > 0)
            <div class="customer-feedback">
                <h3>Customer feedback</h3>
                    @foreach($project_reviews->take(5) as $project_review)
                        <div class="col-md-12 c_feedback">
                            <div class="row">
                            <div class="col-md-6">
                                <h5><strong>From:</strong> {{ $project_review->user->name }} <span>{{ $project_review->created_at->format('d M Y') }}</span></h5>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="text-info">
                                    @if($project_review->punctuality == 1)
                                        <span class="cf_rating bg-success"></span>
                                    @else
                                        <span class="cf_rating bg-danger"></span>
                                    @endif

                                    @if($project_review->workmanship == 2)
                                        <span class="cf_rating bg-success"></span>
                                    @else
                                        @if($project_review->workmanship == 1)
                                            <span class="cf_rating bg-warning"></span>
                                        @else
                                            <span class="cf_rating bg-danger"></span>
                                        @endif
                                    @endif

                                    @if($project_review->tidiness == 1)
                                        <span class="cf_rating bg-success"></span>
                                    @else
                                        <span class="cf_rating bg-danger"></span>
                                    @endif

                                    @if($project_review->price_accuracy == 1)
                                        <span class="cf_rating bg-success"></span>
                                    @else
                                        <span class="cf_rating bg-danger"></span>
                                    @endif

                                    @if($project_review->verified == 1)
                                        <span class="verified">
                                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.5007 7.98735C13.0007 10.4874 11.1157 12.8414 8.47071 13.3674C7.1807 13.6243 5.84252 13.4676 4.64672 12.9197C3.45091 12.3719 2.45843 11.4607 1.81061 10.3159C1.16278 9.17119 0.892631 7.85124 1.03862 6.54402C1.18461 5.23681 1.7393 4.00898 2.62371 3.03535C4.43771 1.03735 7.50071 0.48735 10.0007 1.48735" stroke="#27AE60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 6.9873L7.5 9.4873L13.5 2.9873" stroke="#27AE60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <p>{{ $project_review->description }}</p>
                                <div class="col-md-12" id="more_details" style="display: none;">
                                    {{-- <h3>Project photo(s)</h3>
                                    <div class="row">
                                        <div class="pv_top">
                                        <div class="d-inline mr-3"><img src="assets/img/Rectangle 63.jpg" alt=""></div>
                                        <div class="d-inline mr-3"><img src="assets/img/Rectangle 62.jpg" alt=""></div>
                                        </div>
                                    </div> --}}
                                    <h3>
                                        Ratings
                                        <div class="popup ml-3" onclick="myFunction($(this))">
                                        ?
                                        <span class="popuptext myPopup">
                                            <div class="col-12 mb-2"><span class="cf_rating bg-success">A</span> 75% - 100% <span class="ml-3">P - Punctuality</span></div>
                                            <div class="col-12 mb-2"><span class="cf_rating bg-primary">b</span> 50% - 74% <span class="ml-3">W - Workmanship</span></div>
                                            <div class="col-12 mb-2"><span class="cf_rating bg-warning">C</span> 25% - 49% <span class="ml-3">T - Tidiness</span></div>
                                            <div class="col-12"><span class="cf_rating bg-danger">B</span> 0% - 24% <span class="ml-3">P - Price accuracy</span></div>
                                        </span>
                                        </div>
                                    </h3>
                                    <div class="ratings_">
                                        @if($project_review->punctuality == 1)
                                            <div class="col-12 mb-2"><span class="cf_rating bg-success">&nbsp;</span> - Punctuality</div>
                                        @else
                                            <div class="col-12 mb-2"><span class="cf_rating bg-danger">&nbsp;</span> - Punctuality</div>
                                        @endif

                                        @if($project_review->workmanship == 2)
                                            <div class="col-12 mb-2"><span class="cf_rating bg-success">&nbsp;</span> - Workmanship</div>
                                        @else
                                            @if($project_review->workmanship == 1)
                                                <div class="col-12 mb-2"><span class="cf_rating bg-warning">&nbsp;</span> - Workmanship</div>
                                            @else
                                                <div class="col-12 mb-2"><span class="cf_rating bg-danger">&nbsp;</span> - Workmanship</div>
                                            @endif
                                        @endif

                                        @if($project_review->tidiness == 1)
                                            <div class="col-12 mb-2"><span class="cf_rating bg-success">&nbsp;</span> - Tidiness</div>
                                        @else
                                            <div class="col-12 mb-2"><span class="cf_rating bg-danger">&nbsp;</span> - Tidiness</div>
                                        @endif

                                        @if($project_review->price_accuracy == 1)
                                            <div class="col-12 mb-2"><span class="cf_rating bg-success">&nbsp;</span> - Price accuracy</div>
                                        @else
                                            <div class="col-12 mb-2"><span class="cf_rating bg-danger">&nbsp;</span> - Price accuracy</div>
                                        @endif
                                    </div>
                                </div>
                                <a href="javascript:void(0);" id="show-more" onclick="showMore(this)">More</a>
                                <a href="javascript:void(0);" id="show-less" onclick="showLess(this)" style="display: none;">Less</a>
                            </div>
                            </div>
                        </div>
                    @endforeach
                <div class="col-md-12 text-center load_more"><a href="javascript:void(0);" id="load_more"> <i class="fa fa-plus"></i> Load more</a></div>
            </div>
        @endif
       </div>
    </div>
 </div>
