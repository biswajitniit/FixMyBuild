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
      public function testTwilio()
      {
        $receiverNumber = "+447729905832";
        //$receiverNumber = "+919832307855";
        $message = "Hi Jehan, This is testing from Chandra. FixMyBuild. Please confirm in skype";
  
        try {
  
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
      }
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


        $html = "<!doctype html>
        <html class='no-js' lang='en'>
           <head>
              <meta charset='utf-8'>
              <meta http-equiv='x-ua-compatible' content='ie=edge'>
              <title>FixMyBuild</title>
              <meta name='description' content=''>
              <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap' rel='stylesheet'>
              <style>
                 body{
                    font-family: 'Roboto', sans-serif;
                 }
                 h1, h2, h3, h4, h5, h6, p, a{
                    font-family: 'Roboto', sans-serif;
                 }
              </style>
           </head>
           <body>
              <table align='center' border='0' cellpadding='0' cellspacing='0' style='background:#F6F6F6;padding: 20px;color:#232f3e; font-family:helvetica,arial,sans-serif; font-size:15px; line-height:24px; margin:20px auto 0; width:600px'>
                 <tbody>
                    <tr>
                       <td>
                          <table border='0' cellpadding='0' cellspacing='0' style='width:100%; padding: 10px;'>
                             <tbody>
                                <tr>
                                   <td>
                                      <table border='0' cellpadding='0' cellspacing='0' style='width:100%; text-align: center;'>
                                         <tbody>
                                            <tr>
                                               <td>
                                                  <img src=".url("frontend/emailtemplateimage/logo.png")." alt=''>
                                               </td>
                                            </tr>
                                            <tr style='height: 40px;'>
                                               <td></td>
                                            </tr>
                                            <tr>
                                               <td>
                                                  <h2 style='font-size: 32px;'>Password Reset</h2>
                                               </td>
                                            </tr>
                                         </tbody>
                                      </table>
                                   </td>
                                </tr>
                                <tr style='height: 30px;'>
                                   <td></td>
                                </tr>
                                <tr>
                                   <td style='text-align: center;background: #FFF;padding:20px 30px;border-radius: 10px;'>
                                      <h5 style='color: #6D717A;font-size: 20px;line-height: 23px;'>If you've lost your password or wish to reset it, use the link below to get started.</h5>
                                      <h4><a href='".route('reset.password.get', $token)."' style='color: #FFF;text-align: center;background: #EE5719;padding: 15px 50px;border-radius: 50px;margin: 10px auto;text-decoration: none;display: inline-block;'>
                                         Reset your password.
                                         </a>
                                      </h4>
                                      <p>If you did not request a password reset, you can safely ignore this email. Only a person with access to your email can reset your account password.</p>
                                   </td>
                                </tr>
                                <tr style='height: 70px;'>
                                   <td></td>
                                </tr>
                                <tr>
                                   <td style='text-align:center'>
                                      <p>Copyright © 2022 FixMyBuild. All Rights Reserved.</p>
                                      <a href='#' style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src=".url("frontend/emailtemplateimage/phone.svg")." alt=''> +447975777666</a>
                                      <a href='#' style='font-size: 14px;margin-right: 5px; text-decoration: none;color:#EE5719;'><img src=".url("frontend/emailtemplateimage/mail.svg")." alt=''> help@fixmybuild.com</a>
                                   </td>
                                </tr>
                             </tbody>
                          </table>
                       </td>
                    </tr>
                 </tbody>
              </table>
           </body>
        </html>";


        $postdata = array(
                        'From'          => 'support@fixmybuild.com',
                        'To'            => $request['email'],
                        'Subject'       => 'Password Reset',
                        'HtmlBody'      => $html,
                        'MessageStream' => 'outbound'
                    );

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.postmarkapp.com/email',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($postdata),
          CURLOPT_HTTPHEADER => array(
            'X-Postmark-Server-Token: 397dcd71-2e20-4a1d-b1fd-24bac29255dc',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

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
        $user = User::where('phone', $request->phone)->first();
        if($user){
            $otp = mt_rand(100000, 999999);
            $data = new OtpPasswordResets();
            $data->user_id = $user->id;
            $data->otp = $otp;
            $data->used = 0;
            $data->created_at = now()->addMinutes(5);
            if(strtotime($data->created_at) < strtotime(now()))
            {
                return back();
            }
            $data->save();
            return redirect()->route('otpVerify.get', ['user_id' => $user->id])
                            ->with('success',  "OTP has been sent on Your Mobile Number.");
        } else {
            return back()->with('message', $request->phone.' is Not Register With Us');
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
        $user_id = $request->user_id;
        $user = User::where("id", $user_id)
                                ->first();
        $phone = $user["phone"];
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
                            ->where('id', $request->id)
                            ->first();
          if(!$updatePassword){
          return redirect('/login')->with('error', 'Your password has not  been changed!');
          }
          $user = User::where('id', $request->id)
                      ->update(['password' => Hash::make($request->Password2)]);

          return redirect('/login')->with('message', 'Your password has been changed!');
    }

}
