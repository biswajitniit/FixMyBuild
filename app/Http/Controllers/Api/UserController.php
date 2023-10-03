<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;

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
}
