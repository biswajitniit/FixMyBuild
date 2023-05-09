<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
                                            <tr style='height: 30px;'>
                                               <td></td>
                                            </tr>
                                            <tr>
                                               <td>
                                                  <img src=".url("frontend/emailtemplateimage/Group180.png")." alt=''>
                                               </td>
                                            </tr>
                                            <tr>
                                               <td>
                                                  <h2 style='font-size:24px;'>Hello, ".$request['name'].",</h2>
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
                                      <h5 style='color: #6D717A;font-size: 20px;line-height:23px;'>Welcome to Fixmybuild! You have successfully created an account. Your account has been confirmed. You can start project now.</h5>
                                      <p style='font-size: 20px; margin-top:20px;'>If you have any questions, reach out to us at <br> <a href='#' style='font-size:20px; text-decoration: none;color:#EE5719;'>support@fixmybuild.com</a></p>
                                      <h5 style='color: #061A48;font-size: 16px;line-height:23px;text-align: center;margin-bottom: 10px;'>Team Fixmyuild</h5>
                                      <a href='#' style='margin-right: 10px;text-decoration: none;'>
                                         <svg width='9' height='16' viewBox='0 0 9 16' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                            <path d='M5.91675 6.1665H8.66675V8.9165H5.91675V15.3332H3.16675V8.9165H0.416748V6.1665H3.16675V5.01609C3.16675 3.92617 3.50958 2.54934 4.19158 1.79675C4.87358 1.04234 5.72517 0.666504 6.74542 0.666504H8.66675V3.4165H6.74175C6.28525 3.4165 5.91675 3.785 5.91675 4.24059V6.1665Z' fill='#061A48'></path>
                                         </svg>
                                      </a>
                                      <a href='#'>
                                         <svg width='18' height='14' viewBox='0 0 18 14' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                            <path d='M17.4683 1.71327C16.8321 1.99468 16.1574 2.1795 15.4666 2.26161C16.1947 1.82613 16.7397 1.14078 16.9999 0.333272C16.3166 0.739939 15.5674 1.02494 14.7866 1.17911C14.2621 0.617921 13.5669 0.245741 12.8091 0.120426C12.0512 -0.00488924 11.2732 0.123681 10.596 0.48615C9.91875 0.848618 9.38025 1.42468 9.06418 2.12477C8.74812 2.82486 8.67221 3.60976 8.84826 4.35744C7.46251 4.28798 6.10687 3.92788 4.86933 3.30049C3.63179 2.67311 2.54003 1.79248 1.66492 0.715772C1.35516 1.24781 1.19238 1.85263 1.19326 2.46827C1.19326 3.67661 1.80826 4.74411 2.74326 5.36911C2.18993 5.35169 1.64878 5.20226 1.16492 4.93327V4.9766C1.16509 5.78136 1.44356 6.56129 1.95313 7.18415C2.46269 7.80702 3.17199 8.2345 3.96076 8.39411C3.4471 8.5333 2.90851 8.55382 2.38576 8.45411C2.60814 9.1468 3.04159 9.7526 3.62542 10.1867C4.20924 10.6208 4.9142 10.8614 5.64159 10.8749C4.91866 11.4427 4.0909 11.8624 3.20566 12.1101C2.32041 12.3577 1.39503 12.4285 0.482422 12.3183C2.0755 13.3428 3.93 13.8867 5.82409 13.8849C12.2349 13.8849 15.7408 8.57411 15.7408 3.96827C15.7408 3.81827 15.7366 3.66661 15.7299 3.51827C16.4123 3.02508 17.0013 2.41412 17.4691 1.71411L17.4683 1.71327Z' fill='#061A48'/>
                                         </svg>
                                      </a>
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
        //echo $response;
        return redirect()->back()->with('message', 'Thanks for signing up. Welcome to our fixmybuild. We are happy to have you on board.');
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
    public function termspage(Request $request, $pageid){
        $terms = Terms::where('id',$pageid)->first();
        $termspagename = Terms::where('status','Active')->get();
        return view('cms.terms',compact('terms','termspagename'));
    }

}
