<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
// use App\Http\Requests\ThirdPartyAuthRequest;

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

            if (! $user || ! Hash::check($request->password, @$user->password)) {
                return response()->json(['errors' => ['email' => ['The provided credentials are incorrect!']]], 422);
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
            'customer_or_tradesperson'=>$request->user_type,
            'verification_code'=>strval($random)
        ]);

        if (!$user) {
            throw ValidationException::withMessages(['message' => 'Something went wrong, please try again!'], 400);
        }

        if (Str::lower($request->customer_or_tradesperson) == 'customer') {
            $settings = [
                'reviewed'                  => config('const.customer_notification_reviewed'),
                'paused'                    => config('const.customer_notification_paused'),
                'project_milestone_complete'=> config('const.customer_notification_project_milestone_complete'),
                'project_complete'          => config('const.customer_notification_project_complete'),
                'project_new_message'       => config('const.customer_notification_project_new_message'),
            ];
        } else {
            $settings = [
                // Receive these notifications as a Customer
                'reviewed'                  => config('const.trader_notification_reviewed'),
                'paused'                    => config('const.trader_notification_paused'),
                'project_milestone_complete'=> config('const.trader_notification_project_milestone_complete'),
                'project_complete'          => config('const.trader_notification_project_complete'),
                'project_new_message'       => config('const.trader_notification_project_new_message'),

                // Receive these notifications as a Tradesperson
                'builder_amendment'         => config('const.trader_notification_builder_amendment'),
                'noti_new_quotes'           => config('const.trader_notification_new_estimates'),
                'noti_quote_accepted'       => config('const.trader_notification_estimate_accepted'),
                'noti_project_stopped'      => config('const.trader_notification_project_stopped'),
                'noti_quote_rejected'       => config('const.trader_notification_estimate_rejected'),
                'noti_project_cancelled'    => config('const.trader_notification_project_cancelled'),
                'noti_share_contact_info'   => config('const.trader_notification_share_contact_info'),
                'noti_new_message'          => config('const.trader_notification_trader_new_message'),
            ];
        }

        Notification::create(['user_id' => $user->id,'settings' => $settings]);

        if(strtolower($user->customer_or_tradesperson) == 'tradesperson')
        {
            $token = $user->createToken("asdshjfhsdkjgda.lk,hjmgnhbgfd")->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'user_type'=> $user->customer_or_tradesperson,
                'user'=>$user,
                'token_type' => 'Bearer',
            ], 200);
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


    public function authenticate_with_third_party(Request $request) {

        $validator = Validator::make($request->all(), [
            'user_type' => ['required', 'string', Rule::in(config('const.user_types'))],
            'provider' => ['required', 'string', Rule::in(config('const.providers'))],
            'provider_id' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'terms_of_service' => ['nullable', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $provider_column = $request->provider . "_id";
            $email_verified = 0;
            $email_verified_at = null;

            if ($request->email) {
                $email_verified = 1;
                $email_verified_at = now();
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => $email_verified_at,
                'password' => Hash::make(Str::random(16)),
                'customer_or_tradesperson' => $request->user_type,
                $provider_column => $request->provider_id,
                'verified' => $email_verified,
                'locked' => $email_verified,
                'status' => config('const.status.ACTIVE'),
                'is_email_verified' => $email_verified,
                'steps_completed' => 1,
                'terms_of_service' => $request->terms_of_service,
            ]);

            return response()->json(['message' => 'User registered successfully!'], 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),500);
        }
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
