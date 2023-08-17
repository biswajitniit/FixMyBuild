<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{

    private function roleBasedRedirection($redirectionRouteNameOnError) {
        try {
            if (Auth::user()->customer_or_tradesperson == "Customer")
            {
                if(Auth::user()->status == 'Active'){
                    return redirect()->route('home');
                } else {
                    $errors = new MessageBag(['loginerror' => ['This account is blocked.']]);
                    if (Auth::check()) Auth::logout();
                    Session::flush();
                    return redirect()->route($redirectionRouteNameOnError)->withErrors($errors);
                }
            } else {
                if(Auth::user()->steps_completed == 1 && Auth::user()->status == 'Active') {
                    return redirect()->route('tradepersion.compregistration');
                } else if(Auth::user()->steps_completed == 2 && Auth::user()->status == 'Active') {
                    return redirect()->route('tradepersion.bankregistration');
                } else if(Auth::user()->steps_completed == 3 && Auth::user()->status == 'Active') {
                    return redirect()->route('tradepersion.dashboard');
                } else if(Auth::user()->status != 'Active') {
                    $errors = new MessageBag(['loginerror' => ['This account is blocked.']]);
                    if (Auth::check()) Auth::logout();
                    Session::flush();
                    return redirect()->route($redirectionRouteNameOnError)->withErrors($errors);
                }
            }
        } catch(Exception $e) {
            $errors = new MessageBag(['loginerror' => ['Authentication with Microsoft could not be completed successfully.']]);
            if (Auth::check()) Auth::logout();
            Session::flush();
            return redirect()->route($redirectionRouteNameOnError)->withErrors($errors);
        }

    }

    private function registerWithMicrosoft() {
        try{
            $user = Socialite::with('azure')->stateless()->user();

            if(User::where('email', $user->getEmail())->whereNull('microsoft_id')->first()) {
                $errors = new MessageBag(['loginerror' => ['This email is registered with us through our native login system.']]);
                return redirect()->route('user.registration')->withErrors($errors);
            }

            if(User::where('email', $user->getEmail())->whereNotNull('microsoft_id')->first()) {
                User::where('email', $user->getEmail())->update(['microsoft_id' => $user->getId()]);
                Auth::login(User::where('email', $user->getEmail())->first());
                session()->regenerate();
                return $this->roleBasedRedirection('user.registration');
            }

            $saveuser = User::Create(
                [
                    'steps_completed'             => 1,
                    'verified'                    => 1,
                    'locked'                      => 1,
                    'is_email_verified'           => 1,
                    'customer_or_tradesperson'    => session()->get('user_type'),
                    'phone'                       => session()->get('phone'),
                    'microsoft_id'                   => $user->getId(),
                    'name'                        => $user->getName(),
                    'email'                       => $user->getEmail(),
                    'status'                      => 'Active',
                    'password'                    => Hash::make($user->getName().'@'.$user->getId())
                ]
            );

            $settings = [];

            if (Str::lower(session()->get('user_type')) == 'customer') {
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

            Notification::create([
                'user_id' => $saveuser->id,
                'settings' => $settings
            ]);

            Auth::login($saveuser);
            session()->regenerate();
            return $this->roleBasedRedirection('user.registration');
        } catch(Exception $e) {
            $errors = new MessageBag(['loginerror' => ['Authentication with Microsoft could not be completed successfully.']]);
            if (Auth::check()) Auth::logout();
            Session::flush();
            return redirect()->route('user.registration')->withErrors($errors);
        }
    }

    private function loginWithMicrosoft() {
        try{
            $user = Socialite::driver('azure')->stateless()->user();

            $get_user = User::where('email',$user->getEmail())->first();
            if ($get_user && $get_user->status == "Active") {
                if(User::where('email', $user->getEmail())->whereNotNull('microsoft_id')->first()) {
                    User::where('email', $user->getEmail())->update(['microsoft_id' => $user->getId()]);
                    $get_user = User::where('email',$user->getEmail())->first();
                    Auth::login($get_user);
                    session()->regenerate();
                    return $this->roleBasedRedirection('login');
                }

                if(User::where('email', $user->getEmail())->whereNull('microsoft_id')->first()) {
                    $errors = new MessageBag(['loginerror' => ['This email is registered with us through our native login system.']]);
                    return redirect()->route('login')->withErrors($errors);
                }

            }

            if($get_user) {
                $errors = new MessageBag(['loginerror' => ['This account is blocked.']]);
                return redirect()->route('user.registration')->withErrors($errors);
            }

            $errors = new MessageBag(['loginerror' => ['This email is not registered with us. Please register first.']]);
            return redirect()->route('user.registration')->withErrors($errors);
        } catch(Exception $e) {
            $errors = new MessageBag(['loginerror' => ['Authentication with Microsoft could not be completed successfully.']]);
            if (Auth::check()) Auth::logout();
            Session::flush();
            return redirect()->route('user.registration')->withErrors($errors);
        }
    }

    public function redirect(Request $request){
        if($request->action_type == 'register') {
            session(['user_type' => $request->user_type, 'phone' => $request->phone]);
        }
        session(['action_type' => $request->action_type]);
        return Socialite::driver('azure')->redirect();
    }

    public function callbackFromMicrosoft(){

        if(session()->get('action_type') == 'register')
            return $this->registerWithMicrosoft();
        return $this->loginWithMicrosoft();

        // try {
            // $user = Socialite::driver('azure')->user();
            // $is_user = User::where('email',$user->getEmail())->first();
            // if(!$is_user){
            //     $saveuser = User::updateOrCreate(
            //         [
            //             'microsoft_id' => $user->getId()
            //         ],
            //         [
            //             'name'     => $user->getName(),
            //             'email'    => $user->getEmail(),
            //             'password' => Hash::make($user->getName().'@'.$user->getId())
            //         ]
            //     );
            // }else{
            //     $saveuser = User::where('email',$user->getEmail())->update([
            //         'microsoft_id' => $user->getId()
            //     ]);
            //     $saveuser = User::where('email',$user->getEmail())->first();
            // }
            // Auth::loginUsingId($saveuser->id);
            // if (Auth::user()->customer_or_tradesperson == "Customer")
            // {
            //     if(Auth::user()->status == 'Active'){
            //         return redirect()->intended('/');
            //     }else{
            //         $errors = new MessageBag(['loginerror' => ['Email and/or password invalid.']]);
            //         return Redirect::back()->withErrors($errors)->withInput($request->only('email'));
            //     }
            // }else{
            //     if(Auth::user()->steps_completed == 1){
            //         return redirect()->intended('/tradeperson/company-registration');
            //     }else if(Auth::user()->steps_completed == 2){
            //         return redirect()->intended('/tradeperson/bank-registration');
            //     }else if(Auth::user()->steps_completed == 3){
            //         return redirect()->intended('/');
            //     }
            // }

            // return redirect()->route('dashboard');






            // $azureUser = Socialite::with('azure')->user();
            // $user = User::where('email', $azureUser->email)->first();
            // if(!$user){
            //     // dd($azureUser->getName());
            //     $saveuser = User::updateOrCreate(
            //         [
            //             'microsoft_id' => $azureUser->getId()
            //         ],
            //         [
            //             'steps_completed'             => 1,
            //             'verified'                    => 1,
            //             'locked'                      => 1,
            //             'is_email_verified'           => 1,
            //             'name'                        => $azureUser->getName(),
            //             'email'                       => $azureUser->getEmail(),
            //             'password'                    => Hash::make($azureUser->getName().'@'.$azureUser->getId())
            //         ]
            //     );
            //     Auth::login($saveuser);
            //     return redirect()->route('home');
            // }

            // if($user){
            //     if(Auth::loginUsingId($user->id)){
            //         return redirect()->route('home');
            //     }
            // }


            // if(!$is_user){
            //     $saveuser = User::updateOrCreate(
            //         [
            //             'microsoft_id' => $user->getId()
            //         ],
            //         [
            //             'steps_completed'             => 1,
            //             'verified'                    => 1,
            //             'locked'                      => 1,
            //             'is_email_verified'           => 1,
            //             'customer_or_tradesperson'    => session()->get('user_type'),
            //             'phone'                       => session()->get('phone'),
            //             'name'             => $user->getName(),
            //             'email'            => $user->getEmail(),
            //             'password'         => Hash::make($user->getName().'@'.$user->getId())
            //         ]
            //     );
            // }else{
            //     $saveuser = User::where('email',$user->getEmail())->update([
            //         'microsoft_id' => $user->getId()
            //     ]);
            //     $saveuser = User::where('email',$user->getEmail())->first();
            // }










        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }

}
