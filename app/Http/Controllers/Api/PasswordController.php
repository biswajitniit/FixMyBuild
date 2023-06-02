<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{

    public function forgot_password(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|users',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email','=',$request->email);
        if(!$user){
            return response()->json(['message'=>'User doesnot exists'],400);
        }
        $random = rand(100000,999999);
        $user = User::where('email','=',$request->email)
        ->update(['verification_code'=>strval($random)]);
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
           <p>Your otp is .$random</p>
           </body>
        </html>";


        $postdata = array(
                        'From'          => 'support@fixmybuild.com',
                        'To'            => $request['email'],
                        'Subject'       => 'Fixmybuild',
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

        return response()->json(['otp' => $random,"message"=>'Otp sent to your email'], 201);

    }
    public function verify_otp(Request $request){
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string',
            'email' => 'required|email|users',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email','=',$request->email)
        ->where('verification_code','=',$request->otp);
        if(!$user){
            return response()->json(['message'=>'Otp doesnot match'],400);
        }
        
        return response()->json(['message'=>'Otp verified'],200);
    }
    public function create_password(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=>'required|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email','=',$request->email)
        ->update(['password'=>Hash::make($request->password)]);
        if(!$user){
            return response()->json(['message'=>'Error, please try after sometimes'],400);
        }
        return response()->json(['message'=>'Password changed successfully'],200);
    }
}
