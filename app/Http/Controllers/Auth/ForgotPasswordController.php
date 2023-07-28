<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpPasswordResets;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use AWS\CRT\Log;
use Mail;
use Hash;
use Illuminate\Support\Str;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    //use SendsPasswordResetEmails;

/**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {

          $request->validate([
              'email' => 'required|email|exists:users',
          ],

          [
            'email.exists'    => 'We cannot locate your account.',
          ]);

          $token = Str::random(64);

          DB::table('password_resets')->insert([
              'email' => $request->email,
              'token' => $token,
              'created_at' => Carbon::now()
            ]);

        //   Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
        //       $message->sender('fixmybuild@gmail.com');
        //       $message->to($request->email);
        //       $message->subject('Reset Password');
        //   });


        $html = view('email.reset-password')->with('token', $token)->render();


        $postdata = array(
                        'From'          => env('COMPANY_MAIL'),
                        'To'            => $request['email'],
                        'Subject'       => 'Password Reset',
                        'HtmlBody'      => $html,
                        'MessageStream' => 'outbound'
                    );
        $email_sent = send_email($postdata);

        return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

        //   $updatePassword = DB::table('password_resets')
        //                       ->where([
        //                         'email' => $request->email,
        //                         'token' => $request->token
        //                       ])
        //                       ->first();

        $updatePassword = DB::table('password_resets')
                            ->where('email', '=', $request->email)
                            ->where('token', '=', $request->token)
                            ->where('created_at', '>', Carbon::now()->subHours(2))
                            ->first();


          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('message', 'Your password has been changed!');
      }


    public function generateOtp(Request $request)
    {
        try{
            $user = User::where('phone', $request->phone)->first();
            // dd($request->phone);
            if($user){
                $otp = mt_rand(100000, 999999);
                $data = new OtpPasswordResets();
                $data->user_id = $user->id;
                $data->otp = $otp;
                $data->used = 0;
                $data->created_at = now()->addMinutes(5);

                sendSMS($user,$otp);

                if(strtotime($data->created_at) < strtotime(now()))
                {
                    return back();
                }
                $data->save();
                $table_id = $data->id;
                return redirect()->route('otpVerify.get', ['table_id' => Hashids_encode($table_id)])
                                ->with('success',  "OTP has been sent on Your Mobile Number.");
            } else {
                return back()->with('message', ' We cannot locate your account.');
            }
        } catch(\Exception $e) {
            echo $e;die;
        }

    }
    public function resendOtp(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if($user){
            $otp = mt_rand(100000, 999999);
            $data = new OtpPasswordResets();
            $data->user_id = $user->id;
            $data->otp = $otp;
            $data->used = 0;
            $data->created_at = now()->addMinutes(5);

            sendSMS($user,$otp);

            if(strtotime($data->created_at) < strtotime(now()))
            {
                return false;
            }
            $data->save();
            return true;
        } else {
            return false;
        }
    }


    public function otpVerifyPage(Request $request)
    {
        $table_id = Hashids_decode($request->table_id);
        $tblotp = OtpPasswordResets::where('id', $table_id)->first();
        $user = User::where("id", $tblotp->user_id)
                                ->first();
        $phone = $user["phone"];
        $user_id = $tblotp->user_id;
        return view('auth.smsVerification',compact('user_id','phone'));
    }


    public function verifyOtp(Request $request)
    {
        $user = OtpPasswordResets::where('user_id', $request->id)
        ->where('otp', $request->otp)
        ->get();

        if(count($user)>0){
            $user_id = $user[0]->user_id;
            $data = OtpPasswordResets::where('user_id', $request->id)
                                        ->where('otp', $request->otp)
                                        ->update(array('used' => 1));
            return view('auth.setNewPassword',compact('user_id'));
        }
        else{
            return back()->with('error', 'Wrong OTP');
        }
    }


    public function resetPasswordusingOTP(Request $request){
        $updatePassword = DB::table('users')
                            ->where('id',$request->id)
                            ->first();
          if(!$updatePassword){
          return redirect('/login')->with('error', 'Your password has not  been changed!');
          }
          $user = User::where('id', $request->id)
                      ->update(['password' => Hash::make($request->Password2)]);

          return redirect('/login')->with('message', 'Your password has been changed!');
    }

}
