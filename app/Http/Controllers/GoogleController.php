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
                        'name'     => $user->getName(),
                        'email'    => $user->getEmail(),
                        'password' => Hash::make($user->getName().'@'.$user->getId())
                    ]
                );
            }else{
                $saveuser = User::where('email',$user->getEmail())->update([
                    'google_id' => $user->getId()
                ]);
                $saveuser = User::where('email',$user->getEmail())->first();
            }
            Auth::loginUsingId($saveuser->id);
            return redirect()->route('dashboard');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
