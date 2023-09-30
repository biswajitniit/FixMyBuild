<?php

namespace App\Http\Controllers\Api;

use App\Rules\CustomPasswordRule;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\OtpPasswordResets;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Carbon\Carbon;
use Twilio\Rest\Client;

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
            return response()->json(["errors"=>$e->getMessage()],500);
        }
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:50|unique:users',
            'password' => ['required' ,'string', 'min:8', 'max:32', 'confirmed', new CustomPasswordRule()],
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
            'customer_or_tradesperson' => $request->user_type,
            'steps_completed' => 1,
            'verification_code' => strval($random)
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
            'email' => [
                Rule::requiredIf(
                    in_array($request->provider, [config('const.providers.GOOGLE'), config('const.providers.MICROSOFT')])
                    // Email is optional for Facebook, Apple Signup
                ),
                'email:rfc,dns',
                'unique:users'
            ],
            'terms_of_service' => ['nullable', 'boolean']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $provider_column = $request->provider . "_id";
            $settings = [];

            $userData = [
                'name' => $request->name,
                'password' => Hash::make(Str::random(16)),
                'customer_or_tradesperson' => $request->user_type,
                $provider_column => $request->provider_id,
                'status' => config('const.status.ACTIVE'),
                'steps_completed' => 1,
                'terms_of_service' => $request->terms_of_service
            ];

            if ($request->email) {
                $email_verified = 1;
                $userData['email'] = $request->email;
                $userData['email_verified_at'] = now();
                $userData['verified'] = 1;
                $userData['locked'] = 1;
                $userData['is_email_verified'] = 1;
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

            DB::beginTransaction();
            $user = User::create($userData);
            Notification::create(['user_id' => $user->id,'settings' => $settings]);
            DB::commit();

            $token = $user->createToken(Str::random())->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'user_type'=> $user->customer_or_tradesperson,
                'user'=> $user,
                'token_type' => 'Bearer',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function login_with_third_party(Request $request) {

        $validator = Validator::make($request->all(), [
            'provider' => ['required', 'string', Rule::in(config('const.providers'))],
            'provider_id' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns'],
            'device_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $provider_column = $request->provider . "_id";

            $user = User::where([
                'email' => $request->email,
                $provider_column => $request->provider_id,
            ])->firstOrFail();

            $token = $user->createToken($request->device_name)->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'user_type'=> $user->customer_or_tradesperson,
                'user'=>$user,
                'token_type' => 'Bearer',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()],500);
        }
    }


    public function update_terms_of_service_acceptance(Request $request) {
        $validator = Validator::make($request->all(), [
            'terms_of_service' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::where('id', $request->user()->id)->firstOrFail();
            $user->terms_of_service = $request->terms_of_service;
            $user->save();

            return response()->json(['message' => 'Terms of service updated successfully!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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

    public function forget_password_with_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $otp = mt_rand(100000, 999999);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $otp,
                'created_at' => Carbon::now()
                ]);

            $html = view('email.reset-pswd-email-api')->with('otp', $otp)->render();

            $postdata = array(
                            'From'          => env('MAIL_FROM_ADDRESS'),
                            'To'            => $request['email'],
                            'Subject'       => 'Password Reset',
                            'HtmlBody'      => $html,
                            'MessageStream' => 'outbound'
                        );
            $email_sent = send_email($postdata);

            return response()->json(['message'=>"We have e-mailed your password reset link!"]);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function verify_otp_with_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = PasswordReset::where('email', $request->email)
                                ->where('token', $request->otp)
                                ->first();
            if(!$data){
                return response()->json(['message'=>"Wrong OTP."]);
            }

            return response()->json(['message'=>"OTP verified"]);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function generate_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try{
            $user = User::where('phone', $request->phone)->first();
            if($user){
                $otp = mt_rand(100000, 999999);
                $data = new OtpPasswordResets();
                $data->user_id = $user->id;
                $data->otp = $otp;
                $data->used = 0;
                $data->created_at = now()->addMinutes(5);

                // send otp
                $receiverNumber = $user->phone;
                $message = "This is your Fix my build forget password OTP ".$otp;

                $account_sid = "AC15e8da3b8870bb7ab73cab93cbe287b9";
                $auth_token = "9c2809e405ec441547bf89f95e3c6def";
                $twilio_number = "+447360267868";
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($receiverNumber, [
                    'from' => $twilio_number,
                    'body' => $message]);

                if(strtotime($data->created_at) < strtotime(now()))
                {
                    return response()->json(['message'=>"Time Out"]);
                }
                $data->save();
                return response()->json([
                    'message' => 'OTP has been sent on Your Mobile Number.',
                    'otp' => $otp,
                ]);
            } else {
                return response()->json(['message'=>"We cannot locate your account."]);
            }
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function resend_otp(Request $request)
    {
        try{
            $user = User::where('id', $request->user_id)->first();

            if($user){
                $otp = mt_rand(100000, 999999);
                $data = new OtpPasswordResets();
                $data->user_id = $user->id;
                $data->otp = $otp;
                $data->used = 0;
                $data->created_at = now()->addMinutes(5);

                // send otp
                $receiverNumber = $user->phone;
                $message = "This is your Fix my build forget password OTP ".$otp;

                $account_sid = "AC15e8da3b8870bb7ab73cab93cbe287b9";
                $auth_token = "9c2809e405ec441547bf89f95e3c6def";
                $twilio_number = "+447360267868";
                $client = new Client($account_sid, $auth_token);
                $client->messages->create($receiverNumber, [
                    'from' => $twilio_number,
                    'body' => $message]);

                if(strtotime($data->created_at) < strtotime(now()))
                {
                    return response()->json(['message'=>"Time out."]);
                }
                $data->save();
                return response()->json(['message'=>"OTP has been resent on Your Mobile Number."]);
            } else {
                return response()->json(['message'=>"Something went wrong."]);
            }
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function verify_otp(Request $request)
    {
        try {
            $user = OtpPasswordResets::where('user_id', $request->id)
                                    ->where('otp', $request->otp)
                                    ->first();

            if($user) {
                $user->used = 1;
                $user->update();
            }

            if(!$user){
                return response()->json(['message'=>"Wrong OTP."]);
            }

            return response()->json(['message'=>"OTP verified"]);
        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function reset_password_with_sms(Request $request){
        try{
            $user = User::where('id', $request->id)->first();
            if(!$user){
                return response()->json(['message' => 'We can not locate your account.']);
            }
            if($request->password == $request->password2) {
                $user = User::where('id', $user->id)
                            ->update(['password' => Hash::make($request->password)]);

                return response()->json(['message' => 'Your password has been changed!']);
            } else {
                return response()->json(['message' => 'Your password has not been changed!']);
            }

        } catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
