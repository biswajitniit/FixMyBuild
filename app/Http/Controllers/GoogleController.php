<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\MessageBag;

class GoogleController extends Controller
{

    private function roleBasedRedirection($redirectionRouteNameOnError) {
        try {
            if (Auth::user()->customer_or_tradesperson == "Customer")
            {
                if(Auth::user()->status == 'Active'){
                    return redirect()->route('home');
                } else {
                    $errors = new MessageBag(['loginerror' => ['This account is blocked.']]);
                    Auth::logout();
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
                    Auth::logout();
                    return redirect()->route($redirectionRouteNameOnError)->withErrors($errors);
                }
            }
        } catch(Exception $e) {
            $errors = new MessageBag(['loginerror' => ['Oops! Something went wrong.']]);
            Auth::logout();
            return redirect()->route($redirectionRouteNameOnError)->withErrors($errors);
        }

    }

    private function registerWithGoogle() {
        $user = Socialite::driver('google')->stateless()->user();

        if(User::where('email', $user->getEmail())->whereNull('google_id')->first()) {
            $errors = new MessageBag(['loginerror' => ['This email is registered with us through our native login system.']]);
            return redirect()->route('user.registration')->withErrors($errors);
        }

        if(User::where('email', $user->getEmail())->whereNotNull('google_id')->first()) {
            User::where('email', $user->getEmail())->update(['google_id' => $user->getId()]);
            Auth::login(User::where('email', $user->getEmail())->first());
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
                'google_id'                   => $user->getId(),
                'name'                        => $user->getName(),
                'email'                       => $user->getEmail(),
                'status'                      => 'Active',
                'password'                    => Hash::make($user->getName().'@'.$user->getId())
            ]
        );

        Auth::login($saveuser);
        return $this->roleBasedRedirection('user.registration');
    }

    private function loginWithGoogle() {
        $user = Socialite::driver('google')->stateless()->user();

        $get_user = User::where('email',$user->getEmail())->first();
        if ($get_user && $get_user->status == "Active") {
            if(User::where('email', $user->getEmail())->whereNotNull('google_id')->first()) {
                User::where('email', $user->getEmail())->update(['google_id' => $user->getId()]);
                $get_user = User::where('email',$user->getEmail())->first();
                Auth::login($get_user);
                return $this->roleBasedRedirection('login');
            }

            if(User::where('email', $user->getEmail())->whereNull('google_id')->first()) {
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

    }

    public function redirect(Request $request){
        if($request->action_type == 'register') {
            session(['user_type' => $request->user_type, 'phone' => $request->phone]);
        }
        session(['action_type' => $request->action_type]);
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle(){
        if(session()->get('action_type') == 'register')
            return $this->registerWithGoogle();
        return $this->loginWithGoogle();



        // try {
            // $user = Socialite::driver('google')->stateless()->user();
            // $user = Socialite::with('google')->user();
            // $is_user = User::where('email',$user->getEmail())->first();
            // if(!$is_user){
            //     $saveuser = User::updateOrCreate(
            //         [
            //             'google_id' => $user->getId()
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
            //         'google_id' => $user->getId()
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
            //         return redirect()->back()->withErrors($errors);
            //     }
            // }else{
            //     if(Auth::user()->steps_completed == 1 && Auth::user()->status == 'Active'){
            //         return redirect()->route('tradepersion.compregistration');
            //     }else if(Auth::user()->steps_completed == 2 && Auth::user()->status == 'Active'){
            //         return redirect()->route('tradepersion.bankregistration');
            //     }else if(Auth::user()->steps_completed == 3 && Auth::user()->status == 'Active'){
            //         return redirect()->route('tradepersion.dashboard');
            //     }else{
            //         $errors = new MessageBag(['loginerror' => ['Email and/or password invalid.']]);
            //         return redirect()->back()->withErrors($errors);
            //     }
            // }

        // } catch (Exception $e) {
        //     $errors = new MessageBag(['loginerror' => ['Oops! Something went wrong.']]);
        //     return redirect()->route('user.registration')->withErrors($errors);
        // }
    }

}
