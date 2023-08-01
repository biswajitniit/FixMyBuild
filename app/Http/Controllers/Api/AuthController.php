<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5|max:30',
            'device_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['errors' => ['email' => ['The provided credentials are incorrect!']]], 422);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user_type'=> $user->customer_or_tradesperson,
            'user'=>$user,
            'token_type' => 'Bearer',
        ], 200);
        } catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'user_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $random = rand(100000,999999);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type'=>$request->user_type,
            'verification_code'=>strval($random)
        ]);

        if (!$user) {
            throw ValidationException::withMessages(['message' => 'Something went wrong, please try again!'], 400);
        }

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
                        'From'          => env('MAIL_FROM_ADDRESS'),
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
    public function verify_email(Request $request){
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('email','=',$request->email)
        ->where('verification_code','=',$request->otp)
        ->update(['verified'=>1]);
        if(!$user){
            return response()->json(['message'=>'otp does not match'],400);
        }

        return response()->json(['message'=>'User registered successfully'],200);
    }
}
