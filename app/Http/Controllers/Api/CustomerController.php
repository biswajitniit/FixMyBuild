<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function update_customer_profile(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'email',
            'password' => 'nullable|min:5|max:30',
            'profile_image' => 'nullable|max:'.(config('const.customer_profile_image_size')*1024).'|mimetypes:'.config('const.customer_profile_image_accepted_file_types'),
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $user = $request->user();

            if (!$user) {
                return response()->json(['message' => "User not found."], 404);
            }
            //delete previous image
            $old_pic = $user->profile_image;
            if ($old_pic) {
                $parsedUrl = parse_url($old_pic);

                if ($parsedUrl !== false) {
                    // $s3Path = $parsedUrl['path'];
                    $s3Path = ltrim($parsedUrl['path'], '/');
                    Storage::disk('s3')->delete($s3Path);
                } else {
                    return response()->json(['message' => "Invalid URL"], 400);
                }
            }

             //update profile
            $file = $request->file('profile_image');
            $path = null;

            if ($file) {
                $testFolderName = config('const.s3FolderName');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = explode('/', mime_content_type($file->getRealPath()))[0];

                Storage::disk('s3')->put($testFolderName.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url($testFolderName.$s3FileName);
            }

            $profileData = [
                'name' => $request->name,
                'phone' => $request->phone,
                'profile_image' => $path
            ];

            if ($request->has('password')) {
                $pswd = $request->password;
                $password = Hash::make($pswd);
                $profileData['password'] = $password;
            }

            $profile_update = DB::table('users')->where('id', $user->id)->update($profileData);
            return response()->json(['message'=>"Profile Update has been done successfully."], 200);
        } catch(Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
