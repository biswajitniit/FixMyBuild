@if ($status == 'estimation')
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row table_wrap">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                    <th style="width:80px;">#</th>
                    <th style="width:250px;">Tradesperson name</th>
                    <th style="width:180px;">Total price</th>
                    <th style="width:140px;">Total effort</th>
                    <th style="width:300px;">
                        Customer Feedback <br>
                        <div class="point_">P</div> <div class="point_">W</div> <div class="point_">T</div> <div class="point_">A</div>
                        <div class="popup" id="customer_feedback_tooltip">?
                            <span class="popuptext" id="myPopup">
                                <div class="col-12 mb-2"><span class="cf_rating bg-success">A</span> 75% - 100% <span class="ml-3">P - Punctuality</span></div>
                                <div class="col-12 mb-2"><span class="cf_rating bg-primary">B</span> 50% - 74% <span class="ml-3">W - Workmanship</span></div>
                                <div class="col-12 mb-2"><span class="cf_rating bg-warning">C</span> 25% - 49% <span class="ml-3">T - Tidiness</span></div>
                                <div class="col-12"><span class="cf_rating bg-danger">D</span> 0% - 24% <span class="ml-3">P - Price accuracy</span></div>
                            </span>
                        </div>
                    </th>
                    <th style="width:auto;"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($estimates as $key=>$estimate)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $estimate->tradesperson->name }} </td>
                            {{-- <td>£ {{ $estimate->taskTotalAmount() }}</td> --}}
                            <td>£
                                @if($estimate->price - floor($estimate->price) > 0)
                                    {{ number_format($estimate->price, 2) }}
                                @else
                                    {{ number_format($estimate->price, 0) }}
                                @endif
                                {{-- {{ $estimate->price }} --}}
                            </td>
                            <td>{{ $estimate->total_time }} {{ strtolower($estimate->total_time_type) }}</td>
                            <td class="text-info">
                                {{-- @if (!$estimate->tradesperson->totalRatings()) --}}
                                @if (!$estimate->totalRatings)
                                    No Reviews Found
                                @else
                                    @php
                                        // $ratings = [
                                        //     $estimate->tradesperson->punctualityPercentage(),
                                        //     $estimate->tradesperson->workmanshipPercentage(),
                                        //     $estimate->tradesperson->tidinessPercentage(),
                                        //     $estimate->tradesperson->priceAccuracy(),
                                        // ];
                                        $ratings = [
                                            $estimate->punctualityPercentage,
                                            $estimate->workmanshipPercentage,
                                            $estimate->tidinessPercentage,
                                            $estimate->priceAccuracy,
                                        ];
                                    @endphp

                                    @foreach ($ratings as $rating)
                                        @if ($rating >= 75)
                                            <span class="cf_rating bg-success">A</span>
                                        @elseif ($rating >= 50 && $rating < 75)
                                            <span class="cf_rating bg-primary">B</span>
                                        @elseif ($rating >= 25 && $rating < 50)
                                            <span class="cf_rating bg-primary">C</span>
                                        @else
                                            <span class="cf_rating bg-danger">D</span>
                                        @endif
                                    @endforeach

                                @endif
                            </td>
                            <td><a href="{{ route('Customer.project-estimate', [Hashids_encode($estimate->id)]) }}" class="btn btn-view">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center"> No Estimates Available For This Project Right Now. </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($trader_count > 0)
            <p>
                <img src="{{ asset('frontend/img/in-addition.svg') }}" class="mr-2" alt="">
                In addition, we're currently waiting on estimates from {{ $trader_count }} tradespeople.
            </p>
            @endif
        </div>
        </div>
    </div>
@elseif ($status == 'project_started' || $status == 'awaiting_your_review')
    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="row mb-5">
            <div class="col-md-8">
            <img src="assets/img/Rectangle-82.jpg" alt="" class="mr-2"> <span>AAA. Pvt. Ltd.</span>
            </div>
            <div class="col-md-4 text-right mt-4">
            <h6>Posted on: <span class="date_time">12/01/2023,  11:30 AM</span> </h6>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
            <h2>Milestones details</h2>
            <h3>
                <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z" fill="#061A48"></path>
                </svg>
                Milestone 1
            </h3>
            <p>1. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. </p>
            <p>2. Amet minim mollit non deserunt ullamco amet sint. </p>
            <p>3. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
            <h3>
                <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z" fill="#061A48"></path>
                </svg>
                Milestone 2
            </h3>
            <p>1. Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. </p>
            <p>2. Amet minim mollit non deserunt ullamco amet sint. </p>
            <div class="col-md-12 mb-5">
                <h3>Photo(s)/Video(s)</h3>
                <div class="row">
                    <div class="pv_top">
                        <div class="d-inline mr-3"><img src="assets/img/Rectangle 63.jpg" alt=""></div>
                        <div class="d-inline mr-3"><img src="assets/img/Rectangle 62.jpg" alt=""></div>
                        <div class="d-inline mr-3"><img src="assets/img/Group 296.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <h3>
                <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 19.25V16.5938L18.625 9.96875L21.2812 12.625L14.6562 19.25H12ZM0.75 13V10.5H9.5V13H0.75ZM22.1562 11.75L19.5 9.09375L20.4062 8.1875C20.6354 7.95833 20.9271 7.84375 21.2812 7.84375C21.6354 7.84375 21.9271 7.95833 22.1562 8.1875L23.0625 9.09375C23.2917 9.32292 23.4062 9.61458 23.4062 9.96875C23.4062 10.3229 23.2917 10.6146 23.0625 10.8438L22.1562 11.75ZM0.75 8V5.5H14.5V8H0.75ZM0.75 3V0.5H14.5V3H0.75Z" fill="#061A48"></path>
                </svg>
                Note
            </h3>
            <p>1. The above list of tasks cover all of the work requested under this project.</p>
            <p>2. Upfront payment required:  £120</p>
            <p>3. This estimate includes VAT.</p>
            <h3>Costing of entire project</h3>
            <div class="row cnp_">
                <div class="col-md-5 mt-4 mb-4">
                    <div class="cnp_border">
                        <h6>Cost breakdown including contingency</h6>
                    </div>
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                        Initial payment
                        </div>
                        <div class="col-6">
                        <span>£120</span>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                        Milestone 1
                        </div>
                        <div class="col-6">
                        <span>£120</span>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                        Milestone 2
                        </div>
                        <div class="col-6">
                        <span>£120</span>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                        Milestone 3
                        </div>
                        <div class="col-6">
                        <span>£120</span>
                        </div>
                    </div>
                    <div class="row mt-4 mb-3 cost_b">
                        <div class="col-6">
                        Milestone
                        </div>
                        <div class="col-6">
                        <span>£120</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-md-1 mt-4 total-price">
                    <h6>Total price excluding contingency</h6>
                    <div class="mb-5 price_ec">£2300</div>
                    <h5>Contingency: 20%</h5>
                    <h6>Total price including contingency</h6>
                    <div class="price_ec">£3200</div>
                </div>
            </div>
            <h3>Estimated time required to complete the project:</h3>
            <small>Hours</small>
            <div class="price_ec">100</div>
            <h3>Terms and conditions</h3>
            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
            <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet. deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam.</p>
            </div>
        </div>
    </div>
@endif

