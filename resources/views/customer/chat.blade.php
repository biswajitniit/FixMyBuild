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

                    {{-- <div class="date-line">
                        <hr>
                        <div class="date-area">
                            <div class="date">20-04-2023</div>
                        </div>
                    </div>
                    <div class="date-line">
                        <hr>
                        <div class="date-area">
                        <div class="date">Today</div>
                        </div>
                    </div> --}}

                </div>
            {{-- </div> --}}
                <input type="hidden" id="last_msg_id" value="">
              {{-- </div> --}}
            <div class="chat-footer">
                <form id="new_msg_form" >
                    @csrf
                    {{-- <div class="icon-set">
                        <a href="#">
                            <img src="{{ asset('images/camera-icon.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('images/mingcute_attachment-fill.png') }}" alt="">
                        </a>
                        <a href="#">
                            <img src="{{ asset('images/mdi_microphone.png') }}" alt="">
                        </a>
                    </div> --}}


                    <input type="hidden" id="from_user_id" name="from_user_id" value="{{ Auth::id() }}">
                    <input type="hidden" id="to_user_id" name="to_user_id" value="{{ $estimate->tradesperson_id }}">
                    <input type="hidden" id="project_id" name="project_id" value="{{ $estimate->project_id }}">
                    <input type="hidden" id="estimate_id" name="estimate_id" value="{{ $estimate->id }}">

                    {{--<div class="input-area">
                        <input type="text" id="type_msg" name="type_msg" placeholder="Type here...">
                        <a class="msg-send-icon" type="submit"> --}}
                            {{-- <img src="{{ asset('images/ion_paper-plane.png') }}" alt="">
                        </a>
                        <button type="button" onclick="submitMessage()">Send</button>
                    </div> --}}

                    <div class="input-area">
                        <input type="text" id="type_msg" name="type_msg" placeholder="Type here...">
                        <a class="msg-send-icon" href="javascript:void(0)" onclick="submitMessage()">
                            <img src="{{ asset('images/ion_paper-plane.png') }}" alt="">
                        </a>
                    </div>
                </form>
            </div>
            </div>

        </div>
    </div>
    <!--// END-->
</div>
</div>


@push('scripts')
    <script>
        function submitMessage(event){
            // $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+$('#messsageInput').val()+'</p></div></div>');
            // SEND MESSAGE TO THE CHOSEN USER
            $.ajax({
                method: 'POST',
                url: '{{ route("tradeperson.chat") }}',
                data:{
                    _token: '{{ csrf_token() }}',
                    from_user_id: $('#from_user_id').val(),
                    to_user_id: $('#to_user_id').val(),
                    project_id: $('#project_id').val(),
                    estimate_id: $('#estimate_id').val(),
                    message: $('#type_msg').val()
                },
                success: function(response){
                    // $('#outgoing_msg').html(response.message);
                    // $('#last_msg_id').html(response.last_insert_id);
                    $('#last_msg_id').val(response.last_insert_id);
                    // loadMessagesOfThisConvo();
                    retrieveMessages();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function retrieveMessages(lastMessageId=$('#last_msg_id').val()){
            let i=0;
            const authUser =  $('#from_user_id').val();
            const to_user_id = $('#to_user_id').val();
            $.ajax({
                method: 'GET',
                // url: '/retrive-new-msg/'+to_user_id+'/'+authUser+'/'+lastMessageId,
                url: '{{ route("tradeperson.retrive-new-msg") }}',
                data : {
                    _token: '{{ csrf_token() }}',
                    from_user_id : authUser ,
                    to_user_id : to_user_id,
                    project_id: $('#project_id').val(),
                    last_msg_id: lastMessageId,
                    estimate_id: {{ $estimate->id }}
                },
                success: function(response){
                    console.log(response);
                    while(response[i]!=null){
                        if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id == {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                        <div class="tick mr-2">
                                                <img width="22px" src="{{ asset('images/mdi_tick.png') }}" alt="seen message">
                                            </div>
                                        <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                            ${response[i].message}
                                        </div>
                                        <div>
                                    </div>
                                </div>`;

                                if($(`.msg[data-id="${response[i].id}"]`).length == 0) $('.user2:last-of-type').append(html);
                            // $('.user2:last-of-type').append(html);
                        }
                        // Last Message from other user and new message from currently logged in user
                        else if(($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id == {{ Auth::id() }}) || ($('.chat-window msg-area').length == 0 && response[i].from_user_id == {{ Auth::id() }})) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                                <div class="user2">
                                    <div class="name-time">
                                        <span class="time">${ukTime}</span>
                                        <span class="user-img"><img src="{{ Auth::user()->profile_image ?? asset('images/user.png') }}" class="user-img-chat" alt=""></span>
                                    </div>
                                    <div class="msg-area">
                                        <div class="tick mr-2">
                                            <img src="{{ asset('images/mdi_tick.png') }}" alt="">
                                        </div>
                                        <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                            ${response[i].message}
                                        </div>
                                        <div></div>
                                    </div>
                                </div>`
                                if($(`.msg[data-id="${response[i].id}"]`).length == 0) $('.chat-window').append(html);
                        }
                        // Last Message from other user and new message from other user
                        else if($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id != {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                    <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                        ${response[i].message}`;
                                        if(response[i].is_bookmarked == 1) {
                                            html += `<a href="javascript:void(0)" class="bookmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
                                            </a>`
                                        }
                                    html+=`</div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex copyButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex bookmarkButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span class="bookmark-text">${response[i].is_bookmarked == 0 ? "Bookmark" : "Remove bookmark"}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                if($(`.msg[data-id="${response[i].id}"]`).length == 0) $('.user1:last-of-type').append(html);

                            $.post({
                                url: "{{ route("update.read_status") }}",
                                data: {
                                    _method: "patch",
                                    _token: "{{ csrf_token() }}",
                                    chat_id: response[i].id
                                }
                            });

                        }
                        // Last Message from currently logged in user and new message from other user
                        else if(($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id != {{ Auth::id() }}) || ($('.chat-window msg-area').length == 0 && response[i].from_user_id != {{ Auth::id() }})) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                            <div class="user1">
                                <div class="name-time">
                                    <span class="user-img"><img src="{{ $estimate->tradesperson->profile_image ?? asset('images/user.png') }}" class="user-img-chat" alt=""></span>
                                    <span class="user-name">{{ $estimate->tradesperson->name }}</span>
                                    <span class="time">${ukTime}</span>
                                </div>
                                <div class="msg-area">
                                    <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                        ${response[i].message}`;
                                        if(response[i].is_bookmarked == 1) {
                                            html += `<a href="javascript:void(0)" class="bookmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
                                            </a>`
                                        }
                                    html+=`</div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex copyButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex bookmarkButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span class="bookmark-text">${response[i].is_bookmarked == 0 ? "Bookmark" : "Remove bookmark"}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            if($(`.msg[data-id="${response[i].id}"]`).length == 0) $('.chat-window').append(html);

                            $.post({
                                url: "{{ route("update.read_status") }}",
                                data: {
                                    _method: "patch",
                                    _token: "{{ csrf_token() }}",
                                    chat_id: response[i].id
                                }
                            });
                        }
                        lastMessageId = response[i].id + 1;

                        $('#last_msg_id').val(lastMessageId);
                        i++;
                        $('#type_msg').val('');
                    }
                    // console.log('hello');
                    // scrollPaubos();
                },
                complete: function(response){
                    // retrieveMessages();
                }
            });
        }

        // function scrollPaubos(){
        //     console.log('hii');
        //     var a = document.getElementsByClassName('chat-window');
        //     a.scrollTop = a.scrollHeight;
        // }

        function loadMessagesOfThisConvo(last_msg_id=$('#last_msg_id').val()){
            console.log("loding")
            i=0;
            const authUser =  $('#from_user_id').val();
            const to_user_id = $('#to_user_id').val();
            var last_msg_id = $('#last_msg_id').val();
            console.log(authUser,to_user_id)
            $.ajax({
                method: 'GET',
                // url: '/load-msg/'+to_user_id+'/'+authUser,
                url: '{{ route("tradeperson.load-msg")}}',
                data:{
                    _token: '{{ csrf_token() }}',
                    from_user_id : authUser ,
                    to_user_id : to_user_id,
                    project_id: $('#project_id').val(),
                    last_msg_id: last_msg_id,
                    estimate_id: {{ $estimate->id }}
                },
                success: function(response){
                    // $('#sender_msg').html('');
                    // console.log('from loadMessagesOfThisConvo');
                    // while(response[0][i]!=null){
                    //     if(response[1][0] == response[0][i].message_users_id ){
                    //         $('#sender_msg').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+response[0][i].message +'</p></div></div>');
                    //     }else{
                    //         $('#sender_msg').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[0][i].message +'</p></div></div>');
                    //     }
                    //     // lastMessageId = response[0][i].id + 1;
                    //     lastMessageId = response[i].id + 1;
                    //     $('#last_msg_id').val(lastMessageId);
                    //     i++;
                    // }
                    // scrollPaubos();
                    // retrieveMessages();
                    while(response[i]!=null){
                        if($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id == {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                        <div class="tick mr-2">
                                                <img width="22px" src="{{ asset('images/mdi_tick.png') }}" alt="seen message">
                                            </div>
                                        <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                            ${response[i].message}
                                        </div>
                                        <div>
                                    </div>
                                </div>`;

                            $('.user2:last-of-type').append(html);
                        }
                        // Last Message from other user and new message from currently logged in user
                        else if(($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id == {{ Auth::id() }}) || ($('.chat-window msg-area').length == 0 && response[i].from_user_id == {{ Auth::id() }})) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                                <div class="user2">
                                    <div class="name-time">
                                        <span class="time">${ukTime}</span>
                                        <span class="user-img"><img src="{{ Auth::user()->profile_image ?? asset('images/user.png') }}" class="user-img-chat" alt=""></span>
                                    </div>
                                    <div class="msg-area">
                                        <div class="tick mr-2">
                                            <img src="{{ asset('images/mdi_tick.png') }}" alt="">
                                        </div>
                                        <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                            ${response[i].message}
                                        </div>
                                        <div></div>
                                    </div>
                                </div>`
                            $('.chat-window').append(html);
                        }
                        // Last Message from other user and new message from other user
                        else if($('.chat-window > div:last-child').attr('class') == 'user1' && response[i].from_user_id != {{ Auth::id() }}) {
                            var html = `<div class="msg-area">
                                    <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                        ${response[i].message}`;
                                        if(response[i].is_bookmarked == 1) {
                                            html += `<a href="javascript:void(0)" class="bookmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
                                            </a>`
                                        }
                                    html+=`</div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex copyButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex bookmarkButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span class="bookmark-text">${response[i].is_bookmarked == 0 ? "Bookmark" : "Remove bookmark"}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            $('.user1:last-of-type').append(html);

                            $.post({
                                url: "{{ route("update.read_status") }}",
                                data: {
                                    _method: "patch",
                                    _token: "{{ csrf_token() }}",
                                    chat_id: response[i].id
                                }
                            });
                        }
                        // Last Message from currently logged in user and new message from other user
                        else if(($('.chat-window > div:last-child').attr('class') == 'user2' && response[i].from_user_id != {{ Auth::id() }}) || ($('.chat-window msg-area').length == 0 && response[i].from_user_id != {{ Auth::id() }})) {
                            var date = new Date(response[i].created_at);
                            var options = { timeZone: 'Europe/London', hour12: false, hour: '2-digit', minute:'2-digit' };
                            var ukTime = date.toLocaleString('en-GB', options);
                            var html = `<div class="clearfix"></div>
                            <div class="user1">
                                <div class="name-time">
                                    <span class="user-img"><img src="{{ $estimate->tradesperson->profile_image ?? asset('images/user.png') }}" class="user-img-chat" alt=""></span>
                                    <span class="user-name">{{ $estimate->tradesperson->name }}</span>
                                    <span class="time">${ukTime}</span>
                                </div>
                                <div class="msg-area">
                                    <div class="msg" data-id="${response[i].id}" data-bookmarked="${response[i].is_bookmarked}">
                                        ${response[i].message}`;
                                        if(response[i].is_bookmarked == 1) {
                                            html += `<a href="javascript:void(0)" class="bookmark">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
                                            </a>`
                                        }
                                    html+=`</div>
                                    <div>
                                        <div class="dots">
                                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                                <img width="100%" src="{{ asset('images/three-dot.png') }}" alt="">
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="m-0 px-3 py-1 d-flex copyButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/copy.png') }}" alt=""></span><span>Copy</span>
                                                </a>
                                                <a class="m-0 px-3 py-1 d-flex bookmarkButton" href="javascript:void(0)">
                                                    <span class="mr-2"><img width="100%" src="{{ asset('images/bookmark.png') }}" alt=""></span><span class="bookmark-text">${response[i].is_bookmarked == 0 ? "Bookmark" : "Remove bookmark"}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            $('.chat-window').append(html);
                                                        $.post({
                                url: "{{ route("update.read_status") }}",
                                data: {
                                    _method: "patch",
                                    _token: "{{ csrf_token() }}",
                                    chat_id: response[i].id
                                }
                            });
                        }

                        lastMessageId = response[i].id + 1;
                        $('#last_msg_id').val(lastMessageId);
                        i++;
                        $('#type_msg').val('');
                        // var innerDiv = $(".msg-area:last");
                        // var outerDiv = $('.chat-window')
                        // outerDiv.scrollTop(innerDiv.offset().top - outerDiv.offset().top);
                        // outerDiv.scrollTop(outerDiv.offset().top);
                    }
                }
            });
        }

        // function toggleBookmark() {
        //     var html = `<a href="javascript:void(0)" class="bookmark">
        //                     <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
        //                 </a>`;
        //     var chat_id = $(this).closest('.msg-area').find('.msg').attr('data-id');
        //     console.log($(this).text());
        //     var is_bookmarked = 0;
        //     if($(this).closest('.msg-area').find('.msg .bookmark')) {
        //         $(this).closest('.msg-area').find('.bookmark').remove();
        //         // $(this).find('.bookmark-text').text('Bookmark');
        //     } else {
        //         $(this).closest('.msg-area').find('.msg').append(html);
        //         // $(this).find('.bookmark-text').text('Remove bookmark');
        //         is_bookmarked = 1;
        //     }

        //     $.post({
        //         url: "{{ route('bookmark-msg') }}",
        //         data: {
        //             _method: "patch",
        //             _token: "{{ csrf_token() }}",
        //             is_bookmarked: is_bookmarked,
        //             chat_id: chat_id
        //         }
        //     })

        // }

        $(document).on('click', ".copyButton", function() {
            var textToCopy = $(this).closest('.msg-area').find('.msg').text().trim();
            navigator.clipboard.writeText(textToCopy);
        });

        $(document).on('click', ".bookmarkButton", function() {
            var html = `<a href="javascript:void(0)" class="bookmark">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M0 48V487.7C0 501.1 10.9 512 24.3 512c5 0 9.9-1.5 14-4.4L192 400 345.7 507.6c4.1 2.9 9 4.4 14 4.4c13.4 0 24.3-10.9 24.3-24.3V48c0-26.5-21.5-48-48-48H48C21.5 0 0 21.5 0 48z"></path></svg>
                        </a>`;

            var msgArea = $(this).closest('.msg-area');
            var msg = msgArea.find('.msg');
            var chat_id = msg.attr('data-id');
            var is_bookmarked = Number(msg.attr('data-bookmarked'));

            if (is_bookmarked === 1) {
                msg.find('.bookmark').remove();
                msgArea.find('span.bookmark-text').text('Bookmark');
            } else {
                msg.append(html);
                msgArea.find('span.bookmark-text').text('Remove bookmark');
            }

            msg.attr('data-bookmarked', Number(!is_bookmarked));
            is_bookmarked = Number(!is_bookmarked);

            $.post({
                url: "{{ route('bookmark-msg') }}",
                data: {
                    _method: "patch",
                    _token: "{{ csrf_token() }}",
                    is_bookmarked: is_bookmarked,
                    chat_id: chat_id
                }
            });
        });


        $(function(){
            // $('#nav-chat-tab').click(function(){
                // loadMessagesOfThisConvo(0);
                // var innerDiv = $(".msg-area:last");
                // var outerDiv = $('.chat-window')
                // outerDiv.scrollTop(innerDiv.offset().top - outerDiv.offset().top);
                // loadMessagesOfThisConvo(0).then(function() {
                //     var innerDiv = $(".msg-area:last");
                //     var outerDiv = $('.chat-window')
                //     outerDiv.scrollTop(innerDiv.offset().top - outerDiv.offset().top);
                // });
            // });

            loadMessagesOfThisConvo(0);
            setInterval(retrieveMessages, 5000);
            $('#type_msg').on('keydown', function(event) {
                if (event.key === 'Enter') {
                event.preventDefault();
                }
            });

        });
    </script>

@endpush
