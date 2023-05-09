<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle(){
        try {
            $user = Socialite::driver('google')->user();
            $is_user = User::where('email',$user->getEmail())->first();
            if(!$is_user){
                $saveuser = User::updateOrCreate(
                    [
                        'google_id' => $user->getId()
                    ],
                    [
                        'steps_completed'  => 1,
                        'verified'         => 1,
                        'locked'           => 1,
                        'name'             => $user->getName(),
                        'email'            => $user->getEmail(),
                        'password'         => Hash::make($user->getName().'@'.$user->getId())
                    ]
                );
            }else{
                $saveuser = User::where('email',$user->getEmail())->update([
                    'google_id' => $user->getId()
                ]);
                $saveuser = User::where('email',$user->getEmail())->first();
            }
            Auth::loginUsingId($saveuser->id);
            if (Auth::user()->customer_or_tradesperson == "Customer")
            {
                if(Auth::user()->status == 'Active'){
                    return redirect()->intended('/');
                }else{
                    $errors = new MessageBag(['loginerror' => ['Email and/or password invalid.']]);
                    return Redirect::back()->withErrors($errors)->withInput($request->only('email'));
                }
            }else{
                if(Auth::user()->steps_completed == 1){
                    return redirect()->intended('/tradeperson/company-registration');
                }else if(Auth::user()->steps_completed == 2){
                    return redirect()->intended('/tradeperson/bank-registration');
                }else if(Auth::user()->steps_completed == 3){
                    return redirect()->intended('/');
                }
            }

            return redirect()->route('dashboard');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
