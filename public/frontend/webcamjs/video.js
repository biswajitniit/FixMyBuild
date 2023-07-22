'use strict'

let log = console.log.bind(console),
  id = val => document.getElementById(val),
  ul = id('video-captutes'),
  gUMbtn = id('gUMbtn'),
  start = id('start'),
  stop = id('stop'),
  stream,
  recorder,
  counter=0,
  chunks,
  videoArray = [],
  media;


gUMbtn.onclick = e => {
  let mv = id('mediaVideo'),
      mediaOptions = {
        video: {
          tag: 'video',
          type: 'video/webm',
          ext: '.mp4',
          gUM: {video: true, audio: true}
        },
        audio: {
          tag: 'audio',
          type: 'audio/ogg',
          ext: '.ogg',
          gUM: {audio: true}
        }
      };
//   media = mv.checked ? mediaOptions.video : mediaOptions.audio;
    media = mediaOptions.video;
    navigator.mediaDevices.getUserMedia(media.gUM).then(_stream => {
    stream = _stream;
    id('gUMArea').style.display = 'none';
    id('btns').style.display = 'inherit';
    start.removeAttribute('disabled');
    recorder = new MediaRecorder(stream);
    recorder.ondataavailable = e => {
      chunks.push(e.data);
      if(recorder.state == 'inactive')  makeLink();
    };
    log('got media successfully');
  }).catch(log);
}

start.onclick = e => {
  start.disabled = true;
  stop.removeAttribute('disabled');
  chunks=[];
  $("#my_camera_video").append('<img class="video-record-loading" src="/images/video-record.gif" alt=""></img>');
  recorder.start();
  console.log(recorder.state);
}


stop.onclick = e => {
  stop.disabled = true;
  recorder.stop();
  //stopBothVideoAndAudio(stream);
  //console.log(recorder.state);
  $(".video-record-loading").remove();
  start.removeAttribute('disabled');
}

// function stopBothVideoAndAudio(stream) {
//   stream.getTracks().forEach((track) => {
//     if (track.readyState == 'live') {
//       track.stop();
//     }
//   });
// }

function makeLink(){
  let blob = new Blob(chunks, {type: media.type })
    , url = URL.createObjectURL(blob)
    , li = document.createElement('li')
    , mt = document.createElement(media.tag)
    , hf = document.createElement('div')
  ;
  li.id = "video_"+counter;
  //console.log(blob);
  mt.controls = true;
  mt.src = url;
  //hf.href = url;
  //hf.download = `${counter++}${media.ext}`;
  hf.innerHTML = `<div class="capture-image-level">Video Capture ${counter+1}
            <span class="capture-image-delete" onclick="deleteVideo(${counter++})">&times;</span>
          </div>`;

  li.appendChild(mt);
  li.appendChild(hf);
  ul.appendChild(li);

  //formData.append('_token',  $('meta[name="csrf-token"]').attr('content'));
  //formData.append('video', blob);
  videoArray.push(blob);
  console.log(videoArray);

}
function deleteVideo(index) {
  videoArray.splice(index, 1)
  $('#video_'+index).remove();
}
$(document).ready(function(){
  $('#upload_video').click(function(){
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to upload this video?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
          $("#upload_video").html('<i class="fa fa-circle-o-notch fa-spin"></i> Upload');
          $("#upload_video").prop('disabled', true);
          const formData = new FormData();
          formData.append('_token',  $('meta[name="csrf-token"]').attr('content'));
          formData.append('video_count',  videoArray.length);
        //   formData.append('media_type',  'project');
          for (let i = 0; i < videoArray.length; i++){
            formData.append('video_'+i, videoArray[i]);
          }
          fetch('/capture-video-streaming', {
            method: 'POST',
            body: formData
          })
          .then(response => {
            // console.log(response);
            videoArray = [];
            counter = 0;
            $("#upload_video").html('Upload');
            $("#upload_video").prop('disabled', false);
            $('#close_video_modal').click();
            FetchfilesData();
            if (typeof fetchAllMedias === 'function')
                fetchAllMedias();
            formData.forEach(function(val, key, fD){
                // here you can add filtering conditions
                formData.delete(key)
            });
            $('#video-captutes').html('');
          })
          .catch(error => {});
        }
      });
    });
});
