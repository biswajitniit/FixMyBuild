@extends('layouts.app')

@section('content')
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center pt-5 fmb_titel">
          <h1>My profile</h1>
          <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!--Code area end-->
  <!--Code area start-->
  <section class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 dashboard_sidebar">
          <ul>
            <li @if(Route::is('tradepersion.dashboard')) class="active" @endif>
               <a href="{{route('tradepersion.dashboard')}}">Profile</a>
            </li>
            <li @if(Route::is('tradepersion.projects')) class="active" @endif>
               <a href="{{route('tradepersion.projects')}}">Projects</a>
            </li>
            <li @if(Route::is('tradepersion.settings')) class="active" @endif>
               <a href="{{route('tradepersion.settings')}}">Settings</a>
            </li>
            <li>
               <a href="javascript:void(0)">Logout</a>
            </li>
         </ul>
        </div>
        <div class="col-md-9">
          <div class="col-12 tradperson_tab">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-tradesperson-tab" data-toggle="tab" href="#nav-tradesperson" role="tab" aria-controls="nav-tradesperson" aria-selected="true">As a tradesperson <small>View projects allocated to your company.</small>
                </a>
                <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false">As a customer <small>View projects that you have initiated as a customer.</small>
                </a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-tradesperson" role="tabpanel" aria-labelledby="nav-tradesperson-tab">
                <div class="dashboard_wrapper">
                  <div class="white_bg mb-5">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>New project(s)</h3>
                      </div>
                    </div>
                    <div class="row search-query-wrap">
                      <div class="col-6">
                         <div id="custom-search-input">
                            <div class="input-group">
                                    <input type="text" class="search-query form-control" placeholder="Search..." name="keyword" id="keyword" />
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-danger" >
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 2.00025C6.77609 2.00025 5.12279 2.68507 3.90381 3.90406C2.68482 5.12305 2 6.77635 2 8.50025C2 10.2242 2.68482 11.8775 3.90381 13.0964C5.12279 14.3154 6.77609 15.0003 8.5 15.0003C10.2239 15.0003 11.8772 14.3154 13.0962 13.0964C14.3152 11.8775 15 10.2242 15 8.50025C15 6.77635 14.3152 5.12305 13.0962 3.90406C11.8772 2.68507 10.2239 2.00025 8.5 2.00025ZM1.91687e-08 8.50025C0.000115492 7.14485 0.324364 5.80912 0.945694 4.60451C1.56702 3.3999 2.46742 2.36135 3.57175 1.57549C4.67609 0.789633 5.95235 0.279263 7.29404 0.0869618C8.63574 -0.10534 10.004 0.0260029 11.2846 0.470032C12.5652 0.914061 13.7211 1.6579 14.6557 2.63949C15.5904 3.62108 16.2768 4.81196 16.6576 6.11277C17.0384 7.41358 17.1026 8.7866 16.8449 10.1173C16.5872 11.448 16.015 12.6977 15.176 13.7623L18.828 17.4143C19.0102 17.6029 19.111 17.8555 19.1087 18.1177C19.1064 18.3799 19.0012 18.6307 18.8158 18.8161C18.6304 19.0015 18.3796 19.1066 18.1174 19.1089C17.8552 19.1112 17.6026 19.0104 17.414 18.8283L13.762 15.1763C12.5086 16.1642 11.0024 16.7794 9.41573 16.9514C7.82905 17.1233 6.22602 16.8451 4.79009 16.1485C3.35417 15.4519 2.14336 14.3651 1.29623 13.0126C0.449106 11.66 -0.000107143 10.0962 1.91687e-08 8.50025ZM7.5 5.00025C7.5 4.73504 7.60536 4.48068 7.79289 4.29315C7.98043 4.10561 8.23478 4.00025 8.5 4.00025C9.69347 4.00025 10.8381 4.47436 11.682 5.31827C12.5259 6.16219 13 7.30678 13 8.50025C13 8.76547 12.8946 9.01982 12.7071 9.20736C12.5196 9.3949 12.2652 9.50025 12 9.50025C11.7348 9.50025 11.4804 9.3949 11.2929 9.20736C11.1054 9.01982 11 8.76547 11 8.50025C11 7.83721 10.7366 7.20133 10.2678 6.73249C9.79893 6.26365 9.16304 6.00025 8.5 6.00025C8.23478 6.00025 7.98043 5.8949 7.79289 5.70736C7.60536 5.51982 7.5 5.26547 7.5 5.00025Z" fill="#4F4F4F"/>
                                            </svg>

                                        </button>
                                    </span>
                            </div>
                         </div>
                      </div>
                      <div class="col-6 status_wp">
                         <div class="dropdown" id="sel1">
                            <label class="dropdown-label">Status</label>
                            <div class="dropdown-list">
                              <div class="checkbox">
                                <input type="checkbox" name="new_project_status[]" class="check-all checkbox-custom" id="checkbox-main"/>
                                <label for="checkbox-main" class="checkbox-custom-label">All</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_01"/>
                                <label for="checkbox-custom_01" class="checkbox-custom-label">Write estimate</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_02"/>
                                <label for="checkbox-custom_02" class="checkbox-custom-label">Estimate submitted</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_03"/>
                                <label for="checkbox-custom_03" class="checkbox-custom-label">Estimate recalled</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_04"/>
                                <label for="checkbox-custom_04" class="checkbox-custom-label">Estimate rejected</label>
                              </div>

                              <div class="checkbox">
                               <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_05"/>
                               <label for="checkbox-custom_05" class="checkbox-custom-label">Estimate accepted</label>
                             </div>

                             <div class="checkbox">
                               <input type="checkbox" name="new_project_status[]" class="check checkbox-custom" id="checkbox-custom_06"/>
                               <label for="checkbox-custom_06" class="checkbox-custom-label">Project started</label>
                             </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row table_wrap mt-4">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="width:80px;">#</th>
                              <th style="width:350px;">Name</th>
                              <th style="width:150px;">Posting date</th>
                              <th style="width:300px;">Status</th>
                              <th style="width:auto;"></th>
                            </tr>
                          </thead>
                          <tbody id="table_body">
                            {{-- <tr>
                              <td>01</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-primary">Write estimate</td>
                              <td>
                                <a href="write-estimate.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>02</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="estimate-submitted">Estimate submitted</td>
                              <td>
                                <a href="estimate-submitted.html" class="btn btn-view">View</a>
                              </td>
                            </tr> --}}
                            {{-- @forelse ($estimate_projects as $key=>$estimate_proj)
                                @php
                                    $projectStatus = tradesperson_project_status($estimate_proj->project->id);
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $estimate_proj->project->project_name }}</td>
                                    <td>
                                        {{ $estimate_proj->project->created_at->format('d/m/Y') }} <br>
                                        <em>{{ $estimate_proj->project->created_at->format('g:i A') }}</em>
                                    </td>
                                    <td>
                                    @if ($projectStatus == 'write_estimate')
                                        <span class="text-primary">Write estimate</span>
                                    @elseif ($projectStatus == 'estimate_recalled')
                                        <span class="text-warning">Estimate recalled</span>
                                    @elseif ($projectStatus == 'estimate_submitted')
                                        <span class="text-info">Estimate submitted</span>
                                    @elseif ($projectStatus == 'estimate_rejected')
                                        <span class="text-danger">Estimate rejected</span>
                                    @elseif ($projectStatus == 'estimate_not_accepted')
                                        <span class="text-danger">Estimate not accepted</span>
                                    @elseif ($projectStatus == 'estimate_accepted')
                                        <span class="text-success">Estimate accepted</span>
                                    @else
                                        <span>&nbsp;</span>
                                    @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-view">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Projects Available For You Right Now.</td>
                                </tr>
                            @endforelse --}}
                            @forelse ($estimate_projects as $key=>$estimate_proj)
                                @php
                                    $projectStatus = tradesperson_project_status($estimate_proj->id);
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $estimate_proj->project_name }}</td>
                                    <td>
                                        {{ $estimate_proj->created_at->format('d/m/Y') }} <br>
                                        <em>{{ $estimate_proj->created_at->format('g:i A') }}</em>
                                    </td>
                                    <td>
                                        @if ($projectStatus == 'write_estimate')
                                            <span class="text-primary">Write estimate</span>
                                        @elseif ($projectStatus == 'estimate_recalled')
                                            <span class="text-warning">Estimate recalled</span>
                                        @elseif ($projectStatus == 'estimate_submitted')
                                            <span class="text-info">Estimate submitted</span>
                                        @elseif ($projectStatus == 'estimate_rejected')
                                            <span class="text-danger">Estimate rejected</span>
                                        @elseif ($projectStatus == 'estimate_not_accepted')
                                            <span class="text-danger">Estimate not accepted</span>
                                        @elseif ($projectStatus == 'estimate_accepted')
                                            <span class="text-success">Estimate accepted</span>
                                        @else
                                            <span>&nbsp;</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('tradeperson.project_details', ['project_id' => $estimate_proj->id]) }}" class="btn btn-view">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Projects Available For You Right Now.</td>
                                </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                      <div class="col-12 justify-content-center">
                         <div class="pagination">
                            {{-- {!! $estimate_projects->links() !!} --}}
                            <a href="#" class="prve_"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.5625 12.5C1.5625 15.4008 2.71484 18.1828 4.76602 20.234C6.8172 22.2852 9.59919 23.4375 12.5 23.4375C15.4008 23.4375 18.1828 22.2852 20.234 20.234C22.2852 18.1828 23.4375 15.4008 23.4375 12.5C23.4375 9.59919 22.2852 6.8172 20.234 4.76602C18.1828 2.71484 15.4008 1.5625 12.5 1.5625C9.59919 1.5625 6.8172 2.71484 4.76602 4.76602C2.71484 6.8172 1.5625 9.59919 1.5625 12.5ZM25 12.5C25 15.8152 23.683 18.9946 21.3388 21.3388C18.9946 23.683 15.8152 25 12.5 25C9.18479 25 6.00537 23.683 3.66117 21.3388C1.31696 18.9946 0 15.8152 0 12.5C0 9.18479 1.31696 6.00537 3.66117 3.66117C6.00537 1.31696 9.18479 0 12.5 0C15.8152 0 18.9946 1.31696 21.3388 3.66117C23.683 6.00537 25 9.18479 25 12.5ZM17.9688 11.7188C18.176 11.7188 18.3747 11.8011 18.5212 11.9476C18.6677 12.0941 18.75 12.2928 18.75 12.5C18.75 12.7072 18.6677 12.9059 18.5212 13.0524C18.3747 13.1989 18.176 13.2812 17.9688 13.2812H8.91719L12.2719 16.6344C12.3445 16.707 12.4021 16.7932 12.4414 16.8882C12.4808 16.9831 12.501 17.0848 12.501 17.1875C12.501 17.2902 12.4808 17.3919 12.4414 17.4868C12.4021 17.5818 12.3445 17.668 12.2719 17.7406C12.1992 17.8133 12.113 17.8709 12.0181 17.9102C11.9232 17.9495 11.8215 17.9697 11.7188 17.9697C11.616 17.9697 11.5143 17.9495 11.4194 17.9102C11.3245 17.8709 11.2383 17.8133 11.1656 17.7406L6.47812 13.0531C6.40537 12.9806 6.34765 12.8943 6.30826 12.7994C6.26888 12.7045 6.2486 12.6028 6.2486 12.5C6.2486 12.3972 6.26888 12.2955 6.30826 12.2006C6.34765 12.1057 6.40537 12.0194 6.47812 11.9469L11.1656 7.25937C11.3123 7.11268 11.5113 7.03026 11.7188 7.03026C11.9262 7.03026 12.1252 7.11268 12.2719 7.25937C12.4186 7.40607 12.501 7.60504 12.501 7.8125C12.501 8.01996 12.4186 8.21893 12.2719 8.36563L8.91719 11.7188H17.9688Z" fill="#BDBDBD"/>
                                </svg>
                                </a>
                             <a class="active" href="#">1,</a>
                             <a href="#">2,</a>
                             <a href="#">3,</a>
                             <a href="#">...</a>
                             <a href="#">20</a>
                             <a href="#" class="next_"><svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M23.4375 12.5C23.4375 15.4008 22.2852 18.1828 20.234 20.234C18.1828 22.2852 15.4008 23.4375 12.5 23.4375C9.59919 23.4375 6.8172 22.2852 4.76602 20.234C2.71484 18.1828 1.5625 15.4008 1.5625 12.5C1.5625 9.59919 2.71484 6.8172 4.76602 4.76602C6.8172 2.71484 9.59919 1.5625 12.5 1.5625C15.4008 1.5625 18.1828 2.71484 20.234 4.76602C22.2852 6.8172 23.4375 9.59919 23.4375 12.5ZM0 12.5C0 15.8152 1.31696 18.9946 3.66117 21.3388C6.00537 23.683 9.18479 25 12.5 25C15.8152 25 18.9946 23.683 21.3388 21.3388C23.683 18.9946 25 15.8152 25 12.5C25 9.18479 23.683 6.00537 21.3388 3.66117C18.9946 1.31696 15.8152 0 12.5 0C9.18479 0 6.00537 1.31696 3.66117 3.66117C1.31696 6.00537 0 9.18479 0 12.5ZM7.03125 11.7188C6.82405 11.7188 6.62534 11.8011 6.47882 11.9476C6.33231 12.0941 6.25 12.2928 6.25 12.5C6.25 12.7072 6.33231 12.9059 6.47882 13.0524C6.62534 13.1989 6.82405 13.2812 7.03125 13.2812H16.0828L12.7281 16.6344C12.6555 16.707 12.5979 16.7932 12.5586 16.8882C12.5192 16.9831 12.499 17.0848 12.499 17.1875C12.499 17.2902 12.5192 17.3919 12.5586 17.4868C12.5979 17.5818 12.6555 17.668 12.7281 17.7406C12.8008 17.8133 12.887 17.8709 12.9819 17.9102C13.0768 17.9495 13.1785 17.9697 13.2812 17.9697C13.384 17.9697 13.4857 17.9495 13.5806 17.9102C13.6755 17.8709 13.7617 17.8133 13.8344 17.7406L18.5219 13.0531C18.5946 12.9806 18.6524 12.8943 18.6917 12.7994C18.7311 12.7045 18.7514 12.6028 18.7514 12.5C18.7514 12.3972 18.7311 12.2955 18.6917 12.2006C18.6524 12.1057 18.5946 12.0194 18.5219 11.9469L13.8344 7.25937C13.6877 7.11268 13.4887 7.03026 13.2812 7.03026C13.0738 7.03026 12.8748 7.11268 12.7281 7.25937C12.5814 7.40607 12.499 7.60504 12.499 7.8125C12.499 8.01996 12.5814 8.21893 12.7281 8.36563L16.0828 11.7188H7.03125Z" fill="#061A48"/>
                                </svg>
                             </a>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="white_bg">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>Project history</h3>
                      </div>
                    </div>
                <form action="{{ route('tradepersion.projects') }}" method="GET">
                    <div class="row search-query-wrap">
                      <div class="col-6">
                         <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" class="  search-query form-control" placeholder="Search..." id="name" name="name" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">
                                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 2.00025C6.77609 2.00025 5.12279 2.68507 3.90381 3.90406C2.68482 5.12305 2 6.77635 2 8.50025C2 10.2242 2.68482 11.8775 3.90381 13.0964C5.12279 14.3154 6.77609 15.0003 8.5 15.0003C10.2239 15.0003 11.8772 14.3154 13.0962 13.0964C14.3152 11.8775 15 10.2242 15 8.50025C15 6.77635 14.3152 5.12305 13.0962 3.90406C11.8772 2.68507 10.2239 2.00025 8.5 2.00025ZM1.91687e-08 8.50025C0.000115492 7.14485 0.324364 5.80912 0.945694 4.60451C1.56702 3.3999 2.46742 2.36135 3.57175 1.57549C4.67609 0.789633 5.95235 0.279263 7.29404 0.0869618C8.63574 -0.10534 10.004 0.0260029 11.2846 0.470032C12.5652 0.914061 13.7211 1.6579 14.6557 2.63949C15.5904 3.62108 16.2768 4.81196 16.6576 6.11277C17.0384 7.41358 17.1026 8.7866 16.8449 10.1173C16.5872 11.448 16.015 12.6977 15.176 13.7623L18.828 17.4143C19.0102 17.6029 19.111 17.8555 19.1087 18.1177C19.1064 18.3799 19.0012 18.6307 18.8158 18.8161C18.6304 19.0015 18.3796 19.1066 18.1174 19.1089C17.8552 19.1112 17.6026 19.0104 17.414 18.8283L13.762 15.1763C12.5086 16.1642 11.0024 16.7794 9.41573 16.9514C7.82905 17.1233 6.22602 16.8451 4.79009 16.1485C3.35417 15.4519 2.14336 14.3651 1.29623 13.0126C0.449106 11.66 -0.000107143 10.0962 1.91687e-08 8.50025ZM7.5 5.00025C7.5 4.73504 7.60536 4.48068 7.79289 4.29315C7.98043 4.10561 8.23478 4.00025 8.5 4.00025C9.69347 4.00025 10.8381 4.47436 11.682 5.31827C12.5259 6.16219 13 7.30678 13 8.50025C13 8.76547 12.8946 9.01982 12.7071 9.20736C12.5196 9.3949 12.2652 9.50025 12 9.50025C11.7348 9.50025 11.4804 9.3949 11.2929 9.20736C11.1054 9.01982 11 8.76547 11 8.50025C11 7.83721 10.7366 7.20133 10.2678 6.73249C9.79893 6.26365 9.16304 6.00025 8.5 6.00025C8.23478 6.00025 7.98043 5.8949 7.79289 5.70736C7.60536 5.51982 7.5 5.26547 7.5 5.00025Z" fill="#4F4F4F"/>
                                        </svg>

                                    </button>
                                </span>
                            </div>
                         </div>
                      </div>
                      <div class="col-6 status_wp">
                         <div class="dropdown" id="sel1">
                            <label class="dropdown-label">Status</label>
                            <div class="dropdown-list">
                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group-all" class="check-all checkbox-custom" id="checkbox-main"/>
                                <label for="checkbox-main" class="checkbox-custom-label">All</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom" id="checkbox-custom_01"/>
                                <label for="checkbox-custom_01" class="checkbox-custom-label">Project completed</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom" id="checkbox-custom_02"/>
                                <label for="checkbox-custom_02" class="checkbox-custom-label">Project paused</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom" id="checkbox-custom_03"/>
                                <label for="checkbox-custom_03" class="checkbox-custom-label">Project rejected</label>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </form>
                    <div class="row table_wrap mt-4">
                        @include('tradepersion.project_lists.project_history_list')
                    </div>
                  </div>
                  <!--//-->
                </div>
              </div>
              <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                <div class="dashboard_wrapper">
                  <div class="white_bg mb-5">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>New project(s) <span>
                            <a href="new-customer.html">
                              <i class="fa fa-plus"></i> Add new </a>
                          </span>
                        </h3>
                      </div>
                    </div>
                    <div class="row table_wrap">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="width:80px;">#</th>
                              <th style="width:350px;">Name</th>
                              <th style="width:150px;">Posting date</th>
                              <th style="width:300px;">Status</th>
                              <th style="width:80px;"></th>
                              <th style="width:auto;"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>01</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-info">Submitted for review</td>
                              <td></td>
                              <td>
                                <a href="submitted-for-review.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>02</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-dark">Returned for review</td>
                              <td></td>
                              <td>
                                <a href="#" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>03</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-primary">View estimates</td>
                              <td></td>
                              <td>
                                <a href="project-details-view-estimates.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>04</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-success">Project started</td>
                              <td>
                                <a href="#">
                                  <img src="assets/img/chat-info.svg" alt="">
                                </a>
                              </td>
                              <td>
                                <a href="project-started.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>04</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-awaiting">Awaiting your review</td>
                              <td></td>
                              <td>
                                <a href="awaiting-your-eview.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!--//-->
                  <div class="white_bg">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>Project history</h3>
                      </div>
                    </div>
                    <div class="row table_wrap">
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="width:80px;">#</th>
                              <th style="width:300px;">Name</th>
                              <th style="width:150px;">Posting date</th>
                              <th style="width:300px;">Status</th>
                              <th style="width:auto;"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>01</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-success">Project completed</td>
                              <td>
                                <a href="project-completed.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>02</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-success">Project completed</td>
                              <td>
                                <a href="project-completed.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>03</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-paused">Project paused</td>
                              <td>
                                <a href="project-paused.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>04</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-danger">Project cancelled</td>
                              <td>
                                <a href="project-cancelled.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>05</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-success">Project completed</td>
                              <td>
                                <a href="project-completed.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                            <tr>
                              <td>06</td>
                              <td>Modern bathroom</td>
                              <td>02/01/2023 <br>
                                <em>11:12 am</em>
                              </td>
                              <td class="text-success">Project completed</td>
                              <td>
                                <a href="project-completed.html" class="btn btn-view">View</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!--//-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--// END-->
    </div>
  </section>
@push('scripts')
<script>
function checkboxDropdown(el) {
    var $el = $(el)

    function updateStatus(label, result) {
      if(!result.length) {
        label.html('Status');
      }
    };

    $el.each(function(i, element) {
      var $list = $(this).find('.dropdown-list'),
        $label = $(this).find('.dropdown-label'),
        $checkAll = $(this).find('.check-all'),
        $inputs = $(this).find('.check'),
        defaultChecked = $(this).find('input[type=checkbox]:checked'),
        result = [];

      updateStatus($label, result);
      if(defaultChecked.length) {
        defaultChecked.each(function () {
          result.push($(this).next().text());
          $label.html(result.join(", "));
        });
      }

      $label.on('click', ()=> {
        $(this).toggleClass('open');
      });

      $checkAll.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        result = [];
        if(checked) {
          result.push(checkedText);
          $label.html(result);
          $inputs.prop('checked', false);
        }else{
          $label.html(result);
        }
          updateStatus($label, result);
      });

      $inputs.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        if($checkAll.is(':checked')) {
          result = [];
        }
        if(checked) {
          result.push(checkedText);
          $label.html(result.join(", "));
          $checkAll.prop('checked', false);
        }else{
          let index = result.indexOf(checkedText);
          if (index >= 0) {
            result.splice(index, 1);
          }
          $label.html(result.join(", "));
        }
        updateStatus($label, result);
      });

      $(document).on('click touchstart', e => {
        if(!$(e.target).closest($(this)).length) {
          $(this).removeClass('open');
        }
      });
    });
};

checkboxDropdown('.dropdown');

$(document).ready(function(){
    $(document).on('keyup','#keyword', function(){
        fetchTableData($(this).val());
    })
    //fetchTableData($(this).val());
});

$('input[name="new_project_status[]"]').on('click', function() {
    console.log('clicked');
});

function fetchTableData(keyword) {
    $.ajax({
        url: "{{ route('tradesperson.searchprojects') }}",
        data: {'keyword': keyword},
        success: function(response) {
            $('#table_body').html(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}
</script>
{{-- <script>
    $(document).ready(function(){

     $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
     });

     function fetch_data(page)
     {
      var _token = $("input[name=_token]").val();
      $.ajax({
          url:"{{ route('pagination.fetch') }}",
          method:"POST",
          data:{_token:_token, page:page},
          success:function(data)
          {
           $('#table_body').html(data);
          }
        });
     }

    });
</script> --}}
@endpush
@endsection
