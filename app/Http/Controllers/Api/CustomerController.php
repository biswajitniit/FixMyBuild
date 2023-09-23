<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function update_customer_profile(Request $request){
        $validator = Validator::make($request->all(), [
            // 'profile_image' => 'sometimes',
            'profile_image' => 'max:'.(config('const.customer_profile_image_size')*1024).'|mimetypes:'.config('const.customer_profile_image_accepted_file_types'),
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            //delete previous image
            $old_pic = User::where('id', $request->user()->id)->first();

            if ($old_pic) {
                $testFolderName = config('const.s3FolderName');
                $parsedUrl = parse_url($old_pic->profile_image);
                if ($parsedUrl !== false) {
                    $s3Path = $parsedUrl['path'];
                    Storage::disk('s3')->delete($s3Path);
                } else {
                    echo "Invalid URL";
                }

                $old_pic->delete();
            } else {
                return response()->json(['message' => "User not found."], 404);
            }

             //update profile
            $file = $request->profile_image;
            $testFolderName = config('const.s3FolderName');
            // $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $s3FileName = Str::uuid().'.'.$extension;
            $file_type = explode('/', mime_content_type($file->getRealPath()))[0];
            Storage::disk('s3')->put($testFolderName.'/'.$s3FileName, file_get_contents($file->getRealPath()));
            $path = Storage::disk('s3')->url($testFolderName.'/'.$s3FileName);

            $profile_update = User::where('id', $request->user()->id)
                                ->update([
                                    'name' => $request->name,
                                    'password' => $request->password,
                                    'phone' => $request->phone,
                                    'profile_image'=> $path
                                ]);
            return response()->json(['message'=>"Profile Update has been done successfully."], 200);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
