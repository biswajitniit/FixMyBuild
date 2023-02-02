<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Session;
class MediaController extends Controller
{


    public function capture_video_streaming(Request $request){

        $filename_with_extention = $request->file('video')->hashname();

        $path =  Storage::disk('public')->put('videos',$request->video);
        $url = Storage::disk('public')->url($path);
        return $url;
    }

    public function capture_photo(Request $request){


    }

}
