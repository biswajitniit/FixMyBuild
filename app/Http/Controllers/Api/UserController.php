<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\TradespersonFile;
use App\Rules\CustomPasswordRule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneWithDialCode;

class UserController extends BaseController
{
    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'old_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('id','=',$request->user()->id)
        ->where('password',Hash::check($request->old_password))
        ->update(['password'=>Hash::make($request->password)]);
        if(!$user){
            return response()->json(['message'=>'Worng password'],400);
        }


        return response()->json(['message'=>'Otp verified'],200);
    }
    public function get_profile(Request $request){
        try{
            $user = User::where('id','=',$request->user()->id)->first();
        return response()->json($user,200);
        }catch(Exception $e){
        return response()->json($e->getMessage(),500);
        }
    }

    public function get_settings(Request $request){
        try {
            return $this->success(Notification::where('user_id', $request->user()->id)->pluck('settings'));
        } catch(Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete_account(Request $request) {
        $validator = Validator::make($request->all(), [
            'account_deletion_reason' => 'required|string',
            'delete_permanently' => 'required|max:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
          $user = User::where('id', $request->user()->id)->first();
          $user->account_deletion_reason=$request->account_deletion_reason;
          $user->delete_permanently=$request->delete_permanently;
          $user->save();
          $user->delete();

          $html = view('email.email-account-delete')->with('user', $user)->render();

          $emaildata = array(
            'From'          =>   env('MAIL_FROM_ADDRESS'),
            'To'            =>   $user->email,
            'Subject'       =>  'Fixmybuild Account Deletion',
            'HtmlBody'      =>   $html,
            'MessageStream' =>  'outbound'
          );

          $email_sent = send_email($emaildata);

          return response()->json(['message'=>"You have successfully deleted your account"]);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
      }


    public function updateProfile(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => ['required', new PhoneWithDialCode()],
            'password' => ['nullable' ,'string', 'min:8', 'max:32', new CustomPasswordRule()],
            'profile_image' => 'nullable|max:'.(config('const.customer_profile_image_size')*1024).'|mimetypes:'.str_replace(' ', '', config('const.customer_profile_image_accepted_file_types')),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = $request->user();

            //delete previous image
            $old_pic = $user->profile_image;
            if ($old_pic) {
                $s3Path = parse_url($old_pic, PHP_URL_PATH);
                Storage::disk('s3')->delete($s3Path);
            }

            // update profile
            $file = $request->file('profile_image');
            $fileName = null;
            $extension = null;
            $file_type = null;
            $path = null;

            if ($file) {
                $testFolderName = config('const.s3FolderName');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = Str::uuid().'.'.$extension;
                $file_type = getMediaType($extension) != 'image' ? 'document' : 'image';

                Storage::disk('s3')->put($testFolderName.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url($testFolderName.$s3FileName);
            }

            $profileData = [
                'name' => $request->name,
                'phone' => $request->mobile,
                'profile_image' => $path
            ];

            if ($request->has('password')) {
                $pswd = $request->password;
                $password = Hash::make($pswd);
                $profileData['password'] = $password;
            }

            DB::beginTransaction();

            DB::table('users')->where('id', $user->id)->update($profileData);

            if (isTrader($user->customer_or_tradesperson)) {
                if ($file) {
                    TradespersonFile::updateOrCreate(
                        [
                            'tradesperson_id' => $user->id,
                            'file_related_to' => 'company_logo'
                        ],
                        [
                            'file_name' => $fileName,
                            'file_extension' => $extension,
                            'file_type' => $file_type,
                            'url' => $path,
                        ]
                    );
                } else {
                    TradespersonFile::where(['tradesperson_id' => $user->id, 'file_related_to' => 'company_logo'])->delete();
                }

            }

            DB::commit();

            return response()->json(['message' => "Profile Update has been done successfully."], 200);
        } catch(Exception $e) {
            DB::rollBack();

            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }




    public function get_notification_settings(Request $request)
    {
        try {
            $response = Notification::where(['user_id' => $request->user()->id])->value('settings');

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([$e->getMessage()], 500);
        }
    }
}
