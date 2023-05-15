<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Cms;
use App\Models\Terms;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Registration page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function registration()
    {
        return view('registration');
    }

    /**
     * save user post data
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function save_user(Request $request){
        $this->validate($request, [
			'name'                          => 'required',
			'email'                         => 'required|unique:users|max:191',
			'phone'                         => 'required',
			'password'                      => 'required|min:6|confirmed',
			'password_confirmation'         => 'required|min:6',
            'customer_or_tradesperson'      => 'required',
        ],[
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'phone.required' => 'Please enter your phone',
            'password.required' => 'Please enter your password',
            'password_confirmation.required' => 'Please enter your confirm password',
            'customer_or_tradesperson.required' => 'Please choose whether you are a Customer or a Tradeperson',
        ]);

        $user = new User();
            $user->name                      = $request['name'];
            $user->email                     = $request['email'];
            $user->phone                     = $request['phone'];
            $user->password                  = Hash::make($request['password']);
            $user->customer_or_tradesperson  = $request['customer_or_tradesperson'];
            $user->phone                     = $request['phone'];
            $user->steps_completed           = 1;
            $user->verified                  = 1;
            $user->locked                    = 1;
            $user->terms_of_service          = $request['terms_of_service'];
            $user->status                    = 'Active';
        $user->save();

        $token = Str::random(64);

        UserVerify::create([
              'user_id' => $user->id,
              'token' => $token
        ]);

        $html = view('email.email-verification-mail')->with('token', $token)->render();

        $postdata = array(
                'From'          => 'support@fixmybuild.com',
                'To'            => $request['email'],
                'Subject'       => 'Verify Email',
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

        return redirect()->back()->with('message', 'Thanks for your registration, please check your inbox! for email verification .');
    }


/**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();

                $html = view('email.email-verify-account')->with('name', $user->name)->render();

                $postdata = array(
                                'From'          => 'support@fixmybuild.com',
                                'To'            => $user->email,
                                'Subject'       => 'Fixmybuild',
                                'HtmlBody'      =>  $html,
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

                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

      return redirect()->route('login')->with('message', $message);
    }



    public function about_us(){
        $cms = Cms::where('cms_pagename','about-us')->first();
        return view('cms.about-us',compact('cms'));
    }
    public function contact_us(){
        $cms = Cms::where('cms_pagename','contact-us')->first();
        return view('cms.contact-us',compact('cms'));
    }
    public function privacy_policy(){
        $cms = Cms::where('cms_pagename','privacy-policy')->first();
        return view('cms.privacy-policy',compact('cms'));
    }
    public function terms_of_service(){
        $cms = Cms::where('cms_pagename','terms-of-service')->first();
        return view('cms.terms-of-service',compact('cms'));
    }

    public function termspage(Request $request, $pageid){
        $terms = Terms::where('id',$pageid)->first();
        $termspagename = Terms::where('status','Active')->get();
        return view('cms.terms',compact('terms','termspagename'));
    }

}
