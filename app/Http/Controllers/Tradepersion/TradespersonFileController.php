<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use App\Models\{TradespersonFile, Tempmedia};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class TradespersonFileController extends Controller
{
    /**
     * Store Tradesperson Company Logo in S3.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function storeLogo(Request $request)
    // {
    //     try{
    //         $user = Auth::user();

    //         $this->validate($request, [
    //             'file_related_to' => 'required|string',
    //             'file_type' =>'required|string',
    //         ]);

    //         $image = $request->file('file');
    //         $fileName = $request->file('file')->getClientOriginalName();
    //         $extension = $image->getClientOriginalExtension();
    //         $path = Storage::disk('s3')->put('Testfolder/'.$fileName,file_get_contents($image->getRealPath(),'public'));
    //         $path = Storage::disk('s3')->url('Testfolder/'.$fileName);

    //         $trader_file = new TradespersonFile([
    //             'tradesperson_id' => $user->id,
    //             'file_related_to' => $request->file_related_to,
    //             'file_type' => $request->file_type,
    //             'file_name' => $fileName,
    //             'file_extension' => $extension,
    //             'url' => $path
    //         ]);
    //         $trader_file->save();

    //         return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
    //     } catch(\Exception $e) {
    //         return response()->json(['error' => 'Failed to store data'],500);
    //     }
    // }
    public function storeLogo(Request $request)
    {
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
                'file_type' =>'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            // Delete Old Logo
            Tempmedia::where(['user_id'=>$user, 'file_related_to' => $request->file_related_to])->delete();

            $temp_media = new Tempmedia();
            $temp_media->user_id           = $user;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $request->file_type;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function storePLI(Request $request)
    {
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $fileType = '';
            if($extension == 'pdf')
                $fileType = 'document';
            else
                $fileType = 'image';

            // Delete Old File
            Tempmedia::where(['user_id'=>$user, 'file_related_to' => $request->file_related_to])->delete();

            $temp_media = new Tempmedia();
            $temp_media->user_id           = $user;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $fileType;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function storeTraderImg(Request $request)
    {
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $fileType = '';
            if($extension == 'pdf')
                $fileType = 'document';
            else
                $fileType = 'image';

            // Delete Old Logo
            Tempmedia::where(['user_id'=>$user, 'file_related_to' => $request->file_related_to])->delete();

            $temp_media = new Tempmedia();
            $temp_media->user_id           = Auth::user()->id;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $fileType;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function storeCompAddr(Request $request)
    {
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $fileType = '';
            if($extension == 'pdf')
                $fileType = 'document';
            else
                $fileType = 'image';

            // Delete Old File
            Tempmedia::where(['user_id'=>$user, 'file_related_to' => $request->file_related_to])->delete();

            $temp_media = new Tempmedia();
            $temp_media->user_id           = $user;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $fileType;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function storeTempTeamPhoto(Request $request)
    {
        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $fileType = '';
            if($extension == 'pdf')
                $fileType = 'document';
            else
                $fileType = 'image';

            $temp_media = new Tempmedia();
            $temp_media->user_id           = $user;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $fileType;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function storePrevProj(Request $request)
    {
        try{
            $user = Auth::user();

            $this->validate($request, [
                'file_related_to' => 'required|string',
                'file_type' =>'required|string',
            ]);

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $temp_media = new Tempmedia();
            $temp_media->user_id           = Auth::user()->id;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $request->file_type;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

}
