<div class="tab-pane fade" id="nav-chat" role="tabpanel" aria-labelledby="nav-chat-tab">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-wrap">
            {{-- <div class="card-body"> --}}
                <div class="chat-window pb-5">
                   <div class="alert">
                      <div class="icon">
                       <img src="assets/img/mdi_alert-outline.png" alt="">
                      </div>
                      <div class="text">
                       Please do not share personal details (e.g. your name, address, etc) until you have accepted the estimate from your chosen tradesperson and you are clear on how your details will be used by them.
                      </div>
                   </div>

                   <div class="date-line">
                   <hr>
                   <div class="date-area">
                      <div class="date">20-04-2023</div>
                   </div>

                   </div>
                   <div class="user1">
                       <div class="name-time">
                          <span class="user-img"><img src="{{ asset('images/user1.png') }}" class="user-img-chat" alt=""></span>
                          <span class="user-name">Jane Cooper</span>
                          <span class="time">10:30</span>
                       </div>
                       <div class="msg-area">
                          <div class="msg"></div>
                          <div>
                             <div class="dots">

                                <a href="#" data-toggle="dropdown" aria-expanded="false">
                                   <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">

                                </a>
                                <div class="dropdown-menu">
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                   </a>
                                </div>
                                </div>
                          </div>
                       </div>
                       <div class="msg-area">
                          <div class="msg">
                             Amet minim mollit non deserunt ullamco est sit aliqua.
                          </div>
                          <div>
                             <div class="dots">

                                <a href="#" data-toggle="dropdown" aria-expanded="false">
                                   <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">

                                </a>
                                <div class="dropdown-menu">
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                   </a>
                                   <a class="m-0 px-3 py-1 d-flex">
                                      <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                   </a>
                                </div>
                                </div>
                          </div>
                       </div>
                   </div>
                   <div class="date-line">
                    <hr>
                    <div class="date-area">
                       <div class="date">Today</div>
                    </div>

                 </div>

                 <div class="user2">
                    <div class="name-time">
                       <span class="time">10:30</span>
                       <span class="user-img"><img src="{{ asset('images/user2.png') }}" class="user-img-chat" alt=""></span>


                    </div>
                    <div class="msg-area">
                       <div class="tick mr-2">
                            <img width="50px" src="{{ asset('images/mdi_tick.png') }}" alt="">
                        </div>
                       <div class="msg" id="outgoing_msg"></div>
                       <div>

                       </div>
                    </div>
                    <div class="msg-area">
                       <div class="tick mr-2">
                             <img width="22px" src="{{ asset('images/mdi_tick-all.png') }}" alt="">
                          </div>
                       <div class="msg">

                          Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.
                       </div>
                       <div>

                       </div>
                    </div>

                 </div>
                 <div class="clearfix"></div>
                 <div class="user1">
                    <div class="name-time">
                       <span class="user-img"><img src="{{ asset('images/user1.png') }}" class="user-img-chat" alt=""></span>
                       <span class="user-name">Jane Cooper</span>
                       <span class="time">10:30</span>
                    </div>
                    <div class="msg-area">
                       <div class="msg">
                          Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                       </div>
                       <div>
                          <div class="dots">

                             <a href="#" data-toggle="dropdown" aria-expanded="false">
                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">

                             </a>
                             <div class="dropdown-menu">
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                </a>
                             </div>
                             </div>
                       </div>
                    </div>
                    <div class="msg-area">
                       <div class="msg">
                          Amet minim mollit non deserunt ullamco est sit aliqua.
                       </div>
                       <div>
                          <div class="dots">

                             <a href="#" data-toggle="dropdown" aria-expanded="false">
                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">

                             </a>
                             <div class="dropdown-menu">
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/reply.png') }}" alt=""></span><span>Reply</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/forward.png') }}" alt=""></span><span>Forward</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span>Bookmark</span>
                                </a>
                                <a class="m-0 px-3 py-1 d-flex">
                                   <span class="mr-2"><img width="100%" src="{{ asset('images/report.png') }}" alt=""></span><span>Report a concern</span>
                                </a>
                             </div>
                             </div>
                       </div>
                    </div>
                </div>
                </div>

              {{-- </div> --}}
            <div class="chat-footer">
                <form id="new_msg_form" >
                    @csrf
                    <div class="icon-set">
                        <a href="#">
                            <img src="{{ asset('images/camera-icon.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('images/mingcute_attachment-fill.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('images/mdi_microphone.png') }}" alt="">
                        </a>
                    </div>

                    @if($project->user_id == Auth::id())
                        <input type="hidden" id="from_user_id" name="from_user_id" value="{{ Auth::id() }}">
                        <input type="hidden" id="to_user_id" name="to_user_id" value="{{ $estimate->tradesperson_id }}">
                     @else
                        <input type="hidden" id="to_user_id" name="to_user_id" value="{{ Auth::id() }}">
                        <input type="hidden" id="from_user_id" name="from_user_id" value="{{ $project->user_id }}">
                    @endif
                    <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
                    <input type="hidden" id="estimate_id" name="estimate_id" value="{{ $estimate->id }}">

                    <div class="input-area">
                        <input type="text" id="type_msg" name="type_msg" placeholder="Type here...">
                        {{-- <a class="msg-send-icon" type="submit"> --}}
                            {{-- <img src="{{ asset('images/ion_paper-plane.png') }}" alt="">
                        </a> --}}
                        <button type="button" onclick="submitMessage()">Send</button>
                    </div>
                </form>
            </div>
            </div>

        </div>
    </div>
    <!--// END-->
</div>
</div>


