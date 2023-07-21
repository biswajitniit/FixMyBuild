        <div class="tab-pane fade @if ($projectStatus == 'estimate_accepted' || $projectStatus == 'project_started')active show @endif" id="nav-milestones" role="tabpanel" aria-labelledby="nav-milestones-tab">
          <div class="row table_wrap">
             <div class="table-responsive">
                <table class="table milestones">
                   <thead>
                      <tr>
                         <th style="width:80px;">#</th>
                         <th style="width:200px;">Payment for</th>
                         <th style="width:120px;">Amount</th>
                         <th style="width:180px;">Contingency</th>
                         <th style="width:100px;">Payment </th>
                         <th style="width:auto;">Mark as <br>
                           complete</th>
                      </tr>
                   </thead>
                   <tbody>
                        <tr data-id="{{ $estimate->id }}">
                            <td>1</td>
                            <td>
                                <a href="#">
                                    Initial payment
                                </a>
                            </td>
                            <td>
                                @foreach($tasks as $key=>$task)
                                    @if($task->is_initial == 1)
                                        <div class="col-6">
                                            <span>£{{ number_format($task->price, 2) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>NA</td>
                            <td class="text-warning">Pending</td>
                            <td>
                                <label class="form-check-label" data-bs-toggle="modal" data-bs-target="#Confirm_wp">
                                    @foreach($tasks as $key=>$task)
                                        @if($task->is_initial == 1 && $task->status == 'completed')
                                            <input type="checkbox" class="form-check-input" value="" id='initial_payment_check' checked disabled>
                                        @elseif($task->is_initial == 1)
                                            <input type="checkbox" class="form-check-input" value="" id='initial_payment_check'>
                                        @endif
                                    @endforeach
                                </label>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade select_address" id="Confirm_wp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog">
                               <div class="modal-content">

                                   <div class="modal-body text-center p-5">
                                       <svg width="92" height="92" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path d="M80.5 46C80.5 26.9531 65.0469 11.5 46 11.5C26.9531 11.5 11.5 26.9531 11.5 46C11.5 65.0469 26.9531 80.5 46 80.5C65.0469 80.5 80.5 65.0469 80.5 46Z" stroke="#061A48" stroke-width="5" stroke-miterlimit="10"/>
                                           <path d="M44.9698 29.837L46.0012 51.7499L47.0308 29.837C47.0372 29.6969 47.0149 29.557 46.9654 29.4258C46.9158 29.2946 46.84 29.1749 46.7427 29.074C46.6453 28.9731 46.5284 28.8931 46.399 28.8389C46.2697 28.7847 46.1307 28.7575 45.9904 28.7588C45.8519 28.7601 45.715 28.7894 45.588 28.8447C45.461 28.9001 45.3464 28.9805 45.2511 29.0811C45.1559 29.1818 45.0819 29.3005 45.0335 29.4304C44.9852 29.5603 44.9635 29.6985 44.9698 29.837Z" stroke="#061A48" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                           <path d="M46 66.1084C45.2892 66.1084 44.5944 65.8976 44.0034 65.5027C43.4124 65.1079 42.9518 64.5466 42.6798 63.8899C42.4078 63.2332 42.3366 62.5107 42.4753 61.8135C42.614 61.1164 42.9562 60.4761 43.4588 59.9735C43.9614 59.4709 44.6018 59.1286 45.2989 58.99C45.996 58.8513 46.7186 58.9225 47.3753 59.1945C48.0319 59.4665 48.5932 59.9271 48.9881 60.5181C49.383 61.1091 49.5938 61.8039 49.5938 62.5147C49.5938 63.4678 49.2151 64.3819 48.5412 65.0558C47.8672 65.7298 46.9531 66.1084 46 66.1084Z" fill="#061A48"/>
                                           </svg>

                                       <h5>Confirm</h5>
                                       <h4>Are you sure your work has been completed?</h4>
                                       <p>Please take your decision carefully, because it's can't be revert if you mention mark as completed.</p>
                                   </div>
                                   <div class="modal-footer justify-content-center">
                                        @foreach($tasks as $key=>$task)
                                            @if($task->is_initial == 1)
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="paid_initial('{{ Hashids_encode($task->id) }}')">Yes</button>
                                                <button type="button" class="btn btn-light">No</button>
                                            @endif
                                        @endforeach
                                   </div>
                               </div>
                               </div>
                            </div><!-- Modal END -->
                        </tr>
                    @foreach($tasks as $key=>$task)
                        @if($task->is_initial == 0)
                            <tr data-id="{{ $task->id }}">
                                <td>{{ $key+2 }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="signChange(this,{{ $key }})" id="plus">
                                        <span class="plus-icon">
                                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.8346 6.83171H6.83464V11.8317H5.16797V6.83171H0.167969V5.16504H5.16797V0.165039H6.83464V5.16504H11.8346V6.83171Z" fill="#EE5719"/>
                                            </svg>
                                        </span>
                                        <span class="minus-icon d-none">
                                            <svg width="12" height="2" viewBox="0 0 12 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 0.75C0 0.551088 0.0790175 0.360322 0.21967 0.21967C0.360322 0.0790175 0.551088 0 0.75 0H10.75C10.9489 0 11.1397 0.0790175 11.2803 0.21967C11.421 0.360322 11.5 0.551088 11.5 0.75C11.5 0.948912 11.421 1.13968 11.2803 1.28033C11.1397 1.42098 10.9489 1.5 10.75 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790175 1.13968 0 0.948912 0 0.75Z" fill="#EE5719"/>
                                            </svg>
                                        </span>
                                        <span>Milestone {{ $key }}</span>
                                    </a>
                                </td>
                                <td>£{{ sprintf("%.2f",$task->price) }}</td>
                                <td class="contin_">
                                    @if($task->contingency == null)
                                        <span class="displayVal">{{ sprintf("%.2f", (($task->price * $estimate->contingency)/100) + $task->price) }}</span>
                                    @else
                                        <span class="displayVal">{{ sprintf("%.2f",$task->contingency) }}</span>
                                    @endif

                                    <input type="number" class="d-none inputValue" id="quantity" name="quantity" min="1" max="{{ sprintf("%.2f",(($task->price * $estimate->contingency)/100) + $task->price) }}" >
                                    <span class="max_">(Max. £{{ sprintf("%.2f",(($task->price * $estimate->contingency)/100) + $task->price) }})</span>

                                    @if($task->status == null || $task->status == 'Inactive')
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-pencil ml-2 clickPencil" id='pencil{{ Hashids_encode($task->id) }}' onclick="edit(this)"></i>
                                        </a>
                                        <a href="javascript:void(0);">
                                            <i class="fa fa-check ml-2 d-none clickSave" onclick="save(this)"></i>
                                        </a>
                                    @endif
                                </td>

                                {{-- <td>£{{ $contingency_per_task }} <span class="max_">(Max. £{{ $contingency_per_task }})</span> <a href="#"><i class="fa fa-pencil ml-2"></i></a></td> --}}
                                <td class="text-warning" id="status">Pending</td>
                                <td>
                                    <label class="form-check-label">
                                    @if($task->status == 'completed')
                                        <input type="checkbox" class="form-check-input toggle-class" checked disabled value="">
                                    @else
                                        <input type="checkbox" class="form-check-input toggle-class" value="{{ Hashids_encode($task->id) }}">
                                    @endif
                                    </label>
                                </td>
                                <div class="bg-gradient p-5 d-none">
                                    duiop
                                </div>
                            </tr>
                        @endif
                        <tr class="d-none description-ms_">
                            <td colspan="6">
                                <div class="col-12" >
                                    {{ $task->description }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                   </tbody>
                </table>
             </div>
          </div>
       </div>
