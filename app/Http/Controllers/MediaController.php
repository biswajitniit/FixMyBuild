<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Session;
use Aws\S3\Exception\S3Exception;
use App\Models\Tempmedia;
use League\Flysystem\File;
use App\Models\Projectfile;
class MediaController extends Controller
{


    public function capture_video_streaming(Request $request){

        $filename_with_extention = $request->file('video')->hashname();
        $path =  Storage::disk('public')->put('videos',$request->video);
        $url = Storage::disk('public')->url($path);


        // copy file local storage to s3 bucket
        $file_path = storage_path('app/public/videos/'.$filename_with_extention);
        $spath = Storage::disk('s3')->put('Testfolder/'.$filename_with_extention, file_get_contents($file_path,'public'));
        $spath = Storage::disk('s3')->url('Testfolder/'.$filename_with_extention);

        $tempmedia = new Tempmedia();
        $tempmedia->user_id           = Auth::user()->id;
        $tempmedia->filename          = $filename_with_extention;
        $tempmedia->file_extension    = 'mkv';
        $tempmedia->file_type         = "Video";
        $tempmedia->url               = $spath;
        $tempmedia->file_created_date = date('Y-m-d');
        $tempmedia->save();

        @unlink($file_path);
        return $url;
    }

    public function capture_video_streaming_project_return_for_review(Request $request){

        $filename_with_extention = $request->file('video')->hashname();
        $path =  Storage::disk('public')->put('videos',$request->video);
        $url = Storage::disk('public')->url($path);


        // copy file local storage to s3 bucket
        $file_path = storage_path('app/public/videos/'.$filename_with_extention);
        $spath = Storage::disk('s3')->put('Testfolder/'.$filename_with_extention, file_get_contents($file_path,'public'));
        $spath = Storage::disk('s3')->url('Testfolder/'.$filename_with_extention);

        $videomedia = new Projectfile();
            //$videomedia->project_id        = $request->projectid;
            $videomedia->project_id        = 1;
            $videomedia->filename          = $filename_with_extention;
            $videomedia->file_extension    = 'mkv';
            $videomedia->file_type         = "Video";
            $videomedia->url               = $spath;
        $videomedia->save();

        @unlink($file_path);
        return $url;
    }


    public function capture_photo(Request $request){

         $img = $request->image;
         $folderPath = "uploads/";

         $image_parts = explode(";base64,", $img);
         $image_type_aux = explode("image/", $image_parts[0]);
         $image_type = $image_type_aux[1];

         $image_base64 = base64_decode($image_parts[1]);
         $fileName = uniqid() . '.png';

         $file = $folderPath . $fileName;

        // save in local storage
         $path =  Storage::disk('public')->put($file, $image_base64);
         $url = Storage::disk('public')->url($path);

        // copy file local storage to s3 bucket
        $file_path = storage_path('app/public/uploads/'.$fileName);
        $spath = Storage::disk('s3')->put('Testfolder/'.$fileName, file_get_contents($file_path,'public'));
        $spath = Storage::disk('s3')->url('Testfolder/'.$fileName);

        $tempmedia = new Tempmedia();
        $tempmedia->user_id         = Auth::user()->id;
        $tempmedia->filename        = $fileName;
        $tempmedia->file_type       = "image";
        $tempmedia->file_extension  = 'png';
        $tempmedia->url             = $spath;
        $tempmedia->file_created_date = date('Y-m-d');
        $tempmedia->save();

        // unlink from local storage
        @unlink($file_path);
        return redirect()->back()->with('message', 'Photo added successfully.');

    }

    public function capture_photo_project_return_for_review(Request $request){

        $img = $request->image;
        $folderPath = "uploads/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;

       // save in local storage
        $path =  Storage::disk('public')->put($file, $image_base64);
        $url = Storage::disk('public')->url($path);

       // copy file local storage to s3 bucket
       $file_path = storage_path('app/public/uploads/'.$fileName);
       $spath = Storage::disk('s3')->put('Testfolder/'.$fileName, file_get_contents($file_path,'public'));
       $spath = Storage::disk('s3')->url('Testfolder/'.$fileName);

       $photomedia = new Projectfile();
       $photomedia->project_id        = $request->projectid;
       $photomedia->filename          = $fileName;
       $photomedia->file_type         = "image";
       $photomedia->file_extension    = 'png';
       $photomedia->url               = $spath;
       $photomedia->save();

       // unlink from local storage
       @unlink($file_path);
       return redirect()->back()->with('message', 'Photo added successfully.');

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


        $extension = $request->file->extension();
        $filename = $request->file('file')->getClientOriginalName();
        $file = $request->file('file');
        $path = Storage::disk('s3')->put('Testfolder/'.$filename,file_get_contents($file->getRealPath(),'public'));
        $path = Storage::disk('s3')->url('Testfolder/'.$filename);


        $tempmedia = new Tempmedia();
        $tempmedia->user_id         = Auth::user()->id;
        $tempmedia->filename        = $filename;
        $tempmedia->file_extension  = $extension;
        $tempmedia->file_type       = "Document";
        $tempmedia->url             = $path;
        $tempmedia->file_created_date = date('Y-m-d');
        $tempmedia->save();

        /* Store $imageName name in DATABASE from HERE */

        return response()->json(['success' => $filename]);

    }

    public function dropzonedestroy(Request $request){
         $filename =  $request->get('filename');
         Tempmedia::where('filename',$filename)->delete();
        // $path=public_path().'/images/'.$filename;
        // if (file_exists($path)) {
        //     unlink($path);
        // }
        Storage::disk('s3')->delete('Testfolder/'. $filename);

        return $filename;
    }



}
