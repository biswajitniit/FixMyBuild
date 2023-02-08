<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Session;
use Aws\S3\Exception\S3Exception;
use App\Models\Tempmedia;
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

    public function dropzoneupload(Request $request){
        return view("media/dropzone");
    }
    public function dropzonesave(Request $request){
        // $image = $request->file('file');
        // $FileName = $image->getClientOriginalName();
        // $image->move(public_path('images'), $FileName);

        // $imageUpload = new Tempmedia();
        // $imageUpload->filename = $FileName;
        // $imageUpload->save();
        // return response()->json(['success' => $FileName]);


        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);


        //$extension = $request->file->extension();
        $filename = $request->file('file')->hashname();

        //  $path = Storage::disk('s3')->put('Testfolder', $filename, 'public');
        //  $path = Storage::disk('s3')->url($path);

        $file = $request->file('file');
        \Storage::disk('s3')->put(
                        'Testfolder/'.$filename,
                        file_get_contents($file->getRealPath(), 'public')
                    );

        $tempmedia = new Tempmedia();
        $tempmedia->user_id         = Auth::user()->id;
        $tempmedia->filename        = $filename;
        //$tempmedia->file_extension  = $extension;
        //$tempmedia->url             = $path;
        $tempmedia->file_created_date = date('Y-m-d');
        $tempmedia->save();

        /* Store $imageName name in DATABASE from HERE */

        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image', $path);
        return response()->json(['success' => $filename]);

    }


}
