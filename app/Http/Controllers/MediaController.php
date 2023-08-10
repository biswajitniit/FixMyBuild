<?php

namespace App\Http\Controllers;

use App\Models\FeedbackFile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Session;
use Aws\S3\Exception\S3Exception;
use App\Models\Tempmedia;
use League\Flysystem\File;
use App\Models\Projectfile;
use Illuminate\Support\Str;

class MediaController extends Controller
{

    public function get_video(){
      // $directories = Storage::get('Testfolder');
      // dd($directories);
      $s3 = Storage::disk('s3');
      $file = '90Hz5DzknTRhscmHbUClcX5XDhQt4BaectmV7Rmk.mkv';
      $s3_file = $s3->getDriver()->getAdapter()->getClient()->getObject([
          'Bucket' => env('AWS_BUCKET'),
          'Key' => $file
      ]);
      return response($s3_file['Body'])
          ->header('Content-Type', $s3_file['ContentType'])
          ->header('Content-Disposition', 'attachment; filename="xyz.mp4"');
    }
    public function capture_video_streaming(Request $request){
      try{
        for($i=0; $i<$request->video_count;$i++){
          $vid_var = 'video_'.$i;
          $vid_src = $request->{$vid_var};
          $filename = $vid_src->hashname();
          //dd($filename_with_extention);
          $path =  Storage::disk('public')->put('videos',$vid_src);
          //$url = Storage::disk('public')->url($path);


          // copy file local storage to s3 bucket
          $file_path = storage_path('app/public/videos/'.$filename);
          $status = Storage::disk('s3')->put($filename, file_get_contents($file_path,'public'));
          $spath = Storage::disk('s3')->url($filename);

          $tempmedia = new Tempmedia();
          $tempmedia->user_id           = Auth::user()->id;
          $tempmedia->filename          = $filename;
          $tempmedia->sessionid         = Session::getId();
          $tempmedia->file_extension    = 'mkv';
          $tempmedia->file_type         = "video";
          $tempmedia->media_type        = $request->media_type;
          $tempmedia->url               = $spath;
          $tempmedia->file_created_date = date('Y-m-d');
          $tempmedia->save();

          @unlink($file_path);
        }
        return response()->json([
          'status' => 'success',
          'message' => 'Video Uploaded successfully.',
        ], 200);
      }catch(Exception $e){
        return response()->json([
          'status' => 'error',
          'message' => $e,
        ], 500);
      }
      //  return $url;
    }

    public function capture_video_streaming_project_return_for_review(Request $request){

      $filename_with_extention = $request->file('video')->hashname();
      $path =  Storage::disk('public')->put('videos',$request->video);
      $url = Storage::disk('public')->url($path);
      // copy file local storage to s3 bucket
      $file_path = storage_path('app/public/videos/'.$filename_with_extention);
      $spath = Storage::disk('s3')->put('project_files/'.$filename_with_extention, file_get_contents($file_path,'public'));
      $spath = Storage::disk('s3')->url('project_files/'.$filename_with_extention);

      $videomedia = new Projectfile();
      //$videomedia->project_id        = $request->projectid;
      $videomedia->project_id        = 1;
      $videomedia->filename          = $filename_with_extention;
      $videomedia->sessionid         = Session::getId();
      $videomedia->file_extension    = 'mkv';
      $videomedia->file_type         = "video";
      $videomedia->url               = $spath;
      $videomedia->save();

      @unlink($file_path);
      return $url;
    }


    public function capture_photo(Request $request){

        try{
        for($i=0; $i<$request->image_count;$i++){
         $img_var = 'image_'.$i;
         $img = $request->{$img_var};
         $folderPath = "uploads/";
         $image_parts = explode(";base64,", $img);
         $image_type_aux = explode("image/", $image_parts[0]);
         $image_type = $image_type_aux[1];

         $image_base64 = base64_decode($image_parts[1]);
         $fileName = Str::uuid() . '.png';

         //$file = $folderPath . $fileName;

        // save in local storage
        // $path =  Storage::disk('public')->put($file, $image_base64);
        // $url = Storage::disk('public')->url($path);

        // copy file local storage to s3 bucket
        //$file_path = storage_path('app/public/uploads/'.$fileName);

        $spath = Storage::disk('s3')->put('project_files/'.$fileName, $image_base64);
        $spath = Storage::disk('s3')->url('project_files/'.$fileName);
        //$contents = Storage::disk('s3')->get('project_files/'.$fileName);
        $tempmedia = new Tempmedia();
        $tempmedia->user_id         = Auth::user()->id;
        $tempmedia->filename        = $fileName;
        $tempmedia->sessionid       = Session::getId();
        $tempmedia->file_type       = "image";
        $tempmedia->media_type      = $request->media_type ?? 'customer';
        $tempmedia->file_related_to = $request->file_related_to;
        $tempmedia->file_extension  = 'png';
        $tempmedia->url             = $spath;
        $tempmedia->file_created_date = date('Y-m-d');
        $tempmedia->save();

        // unlink from local storage
        //@unlink($file_path);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Image Uploaded successfully.',
          ], 200);
        }catch(\Exception $e){
          return response()->json([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
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

        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'media_type' => 'required|string',
            ]);

            $files = $request->file('file');
            $response = [];

            // if (!is_array($files)) {
            //     $file = $files;
            //     $fileName = $file->getClientOriginalName();
            //     $extension = $file->getClientOriginalExtension();
            //     $s3FileName = \Str::uuid().'.'.$extension;
            //     Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
            //     $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            //     $single_file_uploads = ['company_logo'];

            //     if( in_array($request->file_related_to, $single_file_uploads)){
            //         $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
            //     }

            //     $fileType = '';
            //     if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
            //         $fileType = 'image';
            //     else
            //         $fileType = 'document';

            //     $temp_media = new Tempmedia();
            //     $temp_media->user_id           = $user;
            //     $temp_media->sessionid         = session()->getId();
            //     $temp_media->file_type         = $fileType;
            //     $temp_media->media_type        = $request->media_type;
            //     $temp_media->filename          = $fileName;
            //     $temp_media->file_extension    = $extension;
            //     $temp_media->url               = $path;
            //     $temp_media->file_created_date = now()->toDateString();
            //     $temp_media->save();
            //     $saved_file                    = $temp_media->id;

            //     if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
            //         $delete_medias_after_save->each(function ($media) {
            //             $media->delete();
            //         });
            //     }

            //     return response()->json(['image_link' => $path, 'file_name' => $fileName, 'file_id' => $saved_file]);
            // }

            foreach($files as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = \Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                $single_file_uploads = ['company_logo'];

                if( in_array($request->file_related_to, $single_file_uploads)){
                    $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
                }

                $fileType  = '';
                $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'heic', 'heif'];
                $video_ext = ['avi', 'mp4', 'm4v', 'ogv', '3gp', '3g2'];
                // if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
                if ( in_array($extension, $image_ext) )
                    $fileType = 'image';
                elseif ( in_array($extension, $video_ext) )
                    $fileType = 'video';
                else
                    $fileType = 'document';

                $temp_media = new Tempmedia();
                $temp_media->user_id           = $user;
                $temp_media->sessionid         = session()->getId();
                $temp_media->file_type         = $fileType;
                $temp_media->media_type        = $request->media_type;
                $temp_media->file_related_to   = $request->file_related_to;
                $temp_media->filename          = $fileName;
                $temp_media->file_extension    = $extension;
                $temp_media->url               = $path;
                $temp_media->file_created_date = now()->toDateString();
                $temp_media->save();
                $saved_file                    = $temp_media->id;

                $uploaded_file = ['image_link' => $path, 'file_name' => $fileName, 'file_id' => $saved_file];
                array_push($response, $uploaded_file);

                if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
                    $delete_medias_after_save->each(function ($media) {
                        $media->delete();
                    });
                }
            }

            return response()->json($response);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }

        // $extension = $request->file->extension();
        // $filename = $request->file('file')->getClientOriginalName();
        // $file = $request->file('file');
        // $path = Storage::disk('s3')->put('Testfolder/'.$filename,file_get_contents($file->getRealPath(),'public'));
        // $path = Storage::disk('s3')->url('Testfolder/'.$filename);


        // $tempmedia = new Tempmedia();
        // $tempmedia->user_id         = Auth::user()->id;
        // $tempmedia->filename        = $filename;
        // $tempmedia->file_extension  = $extension;
        // $tempmedia->file_type       = "Document";
        // $tempmedia->url             = $path;
        // $tempmedia->file_created_date = date('Y-m-d');
        // $tempmedia->save();

        /* Store $imageName name in DATABASE from HERE */

        // return response()->json(['success' => $filename]);

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

    public function deleteTempFile(Request $request) {

        $query = Tempmedia::where('id', $request->file)->first();
        $s3filename = explode("/",$query->url);
        $s3filename = end($s3filename);

        if(Tempmedia::where('id', $request->file)->delete()) {
            Storage::disk('s3')->delete('Testfolder/'. $s3filename);
            return response()->json([
                'response' => 'success',
            ]);
        }

        return response()->json([
            'response' => 'fail',
        ]);
    }

    public function deleteProjectFile(Request $request) {
        // $filename = Projectfile::where('id',$request->deleteid)->first()->filename;
        Projectfile::where('id', $request->deleteid)->delete();
        // Storage::disk('s3')->delete('Testfolder/'. $filename);
    }

    public function getTempFile(Request $request) {

        if (!$request->ajax() || !Auth::user())
            abort(403);

        $temp_medias = Tempmedia::where([
            'user_id'   => Auth::user()->id,
            'sessionid' => Session::getId(),
        ])->when(isset($request->media_type), function ($q) use ($request) {
            return $q->where('media_type', $request->media_type);
        })->when(isset($request->file_type), function ($q) use ($request){
            return $q->where('file_type', $request->file_type);
        })->get();

        return $temp_medias;
    }

    //feedback file submit from review page to feedback_files table
    public function feedback_img(Request $request){
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'media_type' => 'required|string',
            ]);

            $files = $request->file('file');
            $response = [];

            foreach($files as $file) {
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = \Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                $single_file_uploads = ['company_logo'];

                if( in_array($request->file_related_to, $single_file_uploads)){
                    $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
                }

                $fileType  = '';
                $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'heic', 'heif'];
                $video_ext = ['avi', 'mp4', 'm4v', 'ogv', '3gp', '3g2'];
                // if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
                if ( in_array($extension, $image_ext) )
                    $fileType = 'image';
                elseif ( in_array($extension, $video_ext) )
                    $fileType = 'video';
                else
                    $fileType = 'document';

                $feedback_file = new FeedbackFile();
                $feedback_file->project_id                = Hashids_decode($request->project_id)[0];
                $feedback_file->file_type                 = $fileType;
                $feedback_file->file_name                 = $fileName;
                $feedback_file->file_original_name        = $fileName;
                $feedback_file->file_extension            = $extension;
                $feedback_file->url                       = $path;
                $feedback_file->created_at                = now()->toDateString();
                $feedback_file->save();
                $saved_file                 = $feedback_file->id;

                $uploaded_file = ['image_link' => $path, 'file_name' => $fileName, 'file_id' => $saved_file];
                array_push($response, $uploaded_file);

                if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
                    $delete_medias_after_save->each(function ($media) {
                        $media->delete();
                    });
                }
            }

            return response()->json($response);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function get_feedback_img(Request $request, $id){
        try {
            if (Project::where(['id' => Hashids_decode($id), 'user_id' => Auth::id()])->count() == 0)
                return response()->json(['error' => 'Forbidden'],  403);

            $feedbackFiles = FeedbackFile::select('id', 'file_name', 'file_type', 'url')->where('project_id', Hashids_decode($id))->get();
            foreach ($feedbackFiles as $file) {
                $file->encoded_id = Hashids_encode($file->id);
                unset($file->id);
            }
            return $feedbackFiles;
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    public function delete_feedback_img(Request $request) {
        if (Project::where(['id' => Hashids_decode($request->project_id), 'user_id' => Auth::id()])->count() == 0)
            return response()->json(['error' => 'Forbidden'], 403);
        FeedbackFile::where(['id' => Hashids_decode($request->id)])->delete();
    }
}
